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

        $data['nome'] = $this->acesso->logged_user();
        $data['admin'] = $this->acesso->is_admin();

        $this->load->view('templates/header', $data);
        $this->load->view('eventos/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($url_amiga = NULL)
    {
        $data['evento'] = $this->eventos_model->get_eventos($url_amiga);
        $data['admin'] = $this->acesso->is_admin();

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

        $this->acesso->controlar();

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
            $imagem = NULL;
            if(file_exists($_FILES['imagem']['tmp_name'])){
                if(getimagesize($_FILES["imagem"]["tmp_name"]) > 0){
                    $ext = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
                    $nova_imagem = date('Y-m-d H.i.s').'.'.$ext;
                    $caminho = FCPATH."assets/img/eventos/".$nova_imagem;
                    if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho)){
                        $imagem = $nova_imagem;
                    }
                }
            }

            $this->eventos_model->set_eventos($imagem);
            $this->load->view('eventos/successo');
        }
    }

    public function editar($id){

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->acesso->controlar();

        if($id == NULL){
            redirect('eventos');
        }

        $data['evento'] = $this->eventos_model->get_evento_by_id($id);

        if (empty($data['evento']))
        {
            show_404();
        }
        $data['title'] = "Editar evento: ".$data['evento']['titulo'];

        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        $this->form_validation->set_rules('local', 'Local', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            $this->load->view('eventos/editar', $data);
            $this->load->view('templates/footer');

        }
        else
        {

            $evento = $this->eventos_model->get_evento_by_id($id);
            $imagem_anterior = $evento['imagem'];

            if($this->input->post('excluir_img') == "true"){
                unlink(FCPATH."assets/img/eventos/".$imagem_anterior);
                $imagem = NULL;
            }else{
                $imagem = $imagem_anterior;
            }

            if(file_exists($_FILES['imagem']['tmp_name'])){
                if(getimagesize($_FILES["imagem"]["tmp_name"]) > 0){
                    $ext = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
                    $nova_imagem = date('Y-m-d H.i.s').'.'.$ext;
                    $caminho = FCPATH."assets/img/eventos/".$nova_imagem;
                    //echo $caminho; die();
                    if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho)){
                        $imagem = $nova_imagem;
                        unlink(FCPATH."assets/img/eventos/".$imagem_anterior);
                    }
                }
            }

            $nova_url_amiga = $this->eventos_model->update_eventos($id, $imagem);
            redirect('eventos/'.$nova_url_amiga);
        }

    }

    public function deletar($id){

        $this->acesso->controlar();

        if($id == NULL){
            redirect('eventos');
        }

        $this->eventos_model->delete_evento($id);
        redirect('eventos');
    }

}
