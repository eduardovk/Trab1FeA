<?php

class Login extends CI_Controller{

    public function index(){

        $data['title'] = "Fazer Login";

        $data['erro'] = $this->session->flashdata('erro');
        $this->load->view('templates/msg_erro', $data);

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

}
