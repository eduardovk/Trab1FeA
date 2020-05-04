<?php

class Login extends CI_Controller{

    public function index(){

        $data['title'] = "Fazer Login";

        $data['erro'] = $this->session->flashdata('erro');
        $data['sucesso'] = $this->session->flashdata('sucesso');
        $this->load->view('templates/msg_erro', $data);
        $this->load->view('templates/msg_sucesso', $data);

        $this->load->view('templates/header', $data);
        $this->load->view('login/index', $data);
        $this->load->view('templates/footer');
    }

    public function entrar(){
        $this->load->model('usuarios_model');

        $email = $this->input->post("email");
        $senha = sha1($this->input->post("senha"));

        $usuario = $this->usuarios_model->get_usuario($email, $senha);

        if($usuario){
            $this->session->set_userdata("nome", $usuario["nome"]);
            $this->session->set_userdata("admin", $usuario["admin"]);
            $this->session->set_userdata("id_usuario", $usuario["id"]);
            redirect("eventos");
        }else{
            $this->session->set_flashdata('erro', 'E-mail ou senha inválido(s)!');
            redirect("login");
        }
    }

    public function cadastrar(){
        $this->load->model('usuarios_model');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email','E-mail','trim|required');
        $this->form_validation->set_rules('nome','Nome Completo','trim|required');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[3]');
        $this->form_validation->set_rules('senha2', 'Repita a senha', 'required|matches[senha]');

        if ($this->form_validation->run() === FALSE)
        {
            $data['erro'] =  validation_errors();
            $this->load->view('templates/header');
            $this->load->view('templates/msg_erro', $data);
            $this->load->view('templates/msg_sucesso', $data);
            $this->load->view('login/cadastro', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            $usuario = $this->usuarios_model->get_usuario_email($this->input->post('email'));
            if($usuario){
                $data['erro'] = 'Já existe uma uma conta utilizando o email informado!';
                $this->load->view('templates/header');
                $this->load->view('templates/msg_erro', $data);
                $this->load->view('login/cadastro', $data);
                $this->load->view('templates/footer');
            }else{
                if($this->usuarios_model->set_usuario()){
                    $this->session->set_flashdata('sucesso', 'Cadastro concluído com sucesso! Utilize seu e-mail e senha recém cadastrados para fazer o Login:');
                    redirect('login');
                }
            }
        }

    }

    public function logout(){
        if($this->acesso->logged_user()){
            $this->session->unset_userdata('nome');
            $this->session->unset_userdata('admin');
            $this->session->unset_userdata('id_usuario');
            $this->session->sess_destroy();
        }
        redirect("login");
    }

}
