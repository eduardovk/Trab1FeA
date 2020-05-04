<?php
class Inscricoes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('inscricoes_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        if(!$this->acesso->logged_user()){
            redirect('login');
        }

        $id_usuario = $this->session->userdata("id_usuario");

        $data['inscricoes'] = $this->inscricoes_model->get_inscricoes_by_usuario($id_usuario);

        foreach($data['inscricoes'] as &$inscricao){
            $inscricao['valor'] = formatar_moeda($inscricao['valor'], true);
            if($inscricao['pago'] == 1){
                $inscricao['pago'] = "Sim";
            }else{
                $inscricao['pago'] = "Não";
            }
        }

        $data['nome'] = $this->acesso->logged_user();
        $data['admin'] = $this->acesso->is_admin();

        $this->load->view('templates/header', $data);

        $data['erro'] = $this->session->flashdata('erro');
        $data['sucesso'] = $this->session->flashdata('sucesso');
        $this->load->view('templates/msg_erro', $data);
        $this->load->view('templates/msg_sucesso', $data);

        $this->load->view('inscricoes/index', $data);
        $this->load->view('templates/footer');
    }

    public function inscricoes_evento($id_evento){
        $this->load->model('eventos_model');

        $this->acesso->controlar();

        $data['inscricoes'] = $this->inscricoes_model->get_inscricoes_by_evento($id_evento);
        $data['evento'] = $this->eventos_model->get_evento_by_id($id_evento);
        $data['evento']['data'] = formatar_data($data['evento']['data_hora'], true);
        $data['evento']['hora'] = formatar_hora($data['evento']['data_hora'], false);

        foreach($data['inscricoes'] as &$inscricao){
            $inscricao['valor'] = formatar_moeda($inscricao['valor'], true);
            if($inscricao['pago'] == 1){
                $inscricao['pago'] = "Sim";
            }else{
                $inscricao['pago'] = "Não";
            }
        }

        $data['nome'] = $this->acesso->logged_user();
        $data['admin'] = $this->acesso->is_admin();

        $this->load->view('templates/header', $data);

        $data['erro'] = $this->session->flashdata('erro');
        $data['sucesso'] = $this->session->flashdata('sucesso');
        $this->load->view('templates/msg_erro', $data);
        $this->load->view('templates/msg_sucesso', $data);

        $this->load->view('inscricoes/inscricoes_evento', $data);
        $this->load->view('templates/footer');
    }



}
