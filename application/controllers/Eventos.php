<?php
class Eventos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('eventos_model');
        $this->load->helper('url_helper');
    }

    public function index()
    {
        $data['eventos'] = $this->eventos_model->get_eventos();
        $data['title'] = 'Eventos';

        $this->load->view('templates/header', $data);
        $this->load->view('eventos/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($url_amiga = NULL)
    {
        $data['evento'] = $this->eventos_model->get_eventos($url_amiga);

        if (empty($data['evento']))
        {
            show_404();
        }

        $data['title'] = $data['evento']['titulo'];

        $this->load->view('templates/header', $data);
        $this->load->view('eventos/view', $data);
        $this->load->view('templates/footer');
    }

    public function novo()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Cadastrar Novo Evento';

        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        $this->form_validation->set_rules('local', 'Local', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('eventos/novo');
            $this->load->view('templates/footer');

        }
        else
        {
            $this->eventos_model->set_eventos();
            $this->load->view('eventos/successo');
        }
    }

}
