<?php

class Login extends CI_Controller{

    public function index(){
        $data = array();
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);
        //carrega header, msgs de erro, login/index e footer
        carregar_views($this, 'login/index', $data);
    }


    public function entrar(){
        $this->load->model('usuarios_model');
        //captura email e senha informados
        $email = $this->input->post("email");
        $senha = sha1($this->input->post("senha"));
        $usuario = $this->usuarios_model->get_usuario($email, $senha);
        //se foi encontrado usuario com email e senha no bd
        if($usuario){
            //inicializa variaveis de sessao
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
        $data = array();
        $this->form_validation->set_rules('email','E-mail','trim|required');
        $this->form_validation->set_rules('nome','Nome Completo','trim|required');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[3]');
        $this->form_validation->set_rules('senha2', 'Repita a senha', 'required|matches[senha]');

        if ($this->form_validation->run() === FALSE){
            $this->session->set_flashdata('erro', validation_errors());
            //carrega header, msgs de erro, login/cadastro e footer
            carregar_views($this, 'login/cadastro', $data);
        }else{
            //verifica se ja existe usuario com mesmo email cadastrado
            $usuario = $this->usuarios_model->get_usuario_email($this->input->post('email'));
            if($usuario){
                $this->session->set_flashdata('erro', 'Já existe uma uma conta utilizando o email informado!');
                //carrega header, msgs de erro, login/cadastro e footer
                carregar_views($this, 'login/cadastro', $data);
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
