<?php
class Eventos extends CI_Controller {


    public function __construct(){
        parent::__construct();
        $this->load->model('eventos_model');
        $this->load->helper('url_helper');
    }


    public function index(){
        $data['eventos'] = $this->eventos_model->get_eventos();
        //formata a data e hora de cada evento
        foreach($data['eventos'] as &$evento){
            $evento['data'] = formatar_data($evento['data_hora'], true);
            $evento['hora'] = formatar_hora($evento['data_hora'], false);
        }
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);
        //carrega header, msgs de erro, eventos/index e footer
        carregar_views($this, 'eventos/index', $data);
    }


    public function view($url_amiga = NULL){
        $this->load->model('categoriasIngressos_model');

        $data['evento'] = $this->eventos_model->get_eventos($url_amiga);
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);
        check_404($data['evento']);
        //formata a data e hora do evento antes de exibir
        $data['evento']['data'] = formatar_data($data['evento']['data_hora'], true);
        $data['evento']['hora'] = formatar_hora($data['evento']['data_hora'], false);

        // se houver ingressos cadastrados para o evento, formata o valor e calcula a qtd restante
        $ingressos = $this->categoriasIngressos_model->get_cat_ingressos_by_evento($data['evento']['id']);
        if($ingressos){
            foreach($ingressos as &$ingresso){ //foreach usando referencia (&)
                $ingresso['valor'] = formatar_moeda($ingresso['valor'], true);
                $ingresso['qtd_restante'] = $this->categoriasIngressos_model->get_qtd_ingressos($ingresso['id']);
            }
            $data['ingressos'] = $ingressos;
        }
        //carrega header, msgs de erro, eventos/view e footer
        carregar_views($this, 'eventos/view', $data);
    }


    public function novo(){
        $this->load->helper('form');
        $this->load->library('form_validation');
        //impede acesso caso nao seja admin
        $this->acesso->controlar();
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);

        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        $this->form_validation->set_rules('local', 'Local', 'required');
        if ($this->form_validation->run() === FALSE){
            //carrega header, msgs de erro, eventos/novo e footer
            carregar_views($this, 'eventos/novo', $data);
        }else{
            $imagem = NULL;
            //verifica se foi feito upload de imagem
            if(file_exists($_FILES['imagem']['tmp_name'])){
                if(getimagesize($_FILES["imagem"]["tmp_name"]) > 0){
                    $ext = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
                    //especifica nome do arquivo com base na data e hora
                    $nova_imagem = date('Y-m-d H.i.s').'.'.$ext;
                    $caminho = FCPATH."assets/img/eventos/".$nova_imagem;
                    //salva imagem no servidor e recebe o nome dela para salvar no registro no bd
                    if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho)){
                        $imagem = $nova_imagem;
                    }
                }
            }
            if($this->eventos_model->set_eventos($imagem)){
                $this->session->set_flashdata('sucesso', 'Evento cadastrado com sucesso!');
            }
            redirect('eventos');
        }
    }


    public function editar($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        //impede acesso caso nao seja admin
        $this->acesso->controlar();
        check_404($id);
        $data['evento'] = $this->eventos_model->get_evento_by_id($id);
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);
        check_404($data['evento']);
        //formata a data e hora do evento antes de exibir
        $data['evento']['data'] = explode(" ", $data['evento']['data_hora'])[0];
        $data['evento']['hora'] = formatar_hora($data['evento']['data_hora'], false);

        $this->form_validation->set_rules('titulo', 'Título', 'required');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required');
        $this->form_validation->set_rules('local', 'Local', 'required');
        if ($this->form_validation->run() === FALSE){
            //carrega header, msgs de erro, eventos/editar e footer
            carregar_views($this, 'eventos/editar', $data);
        }else{
            $evento = $this->eventos_model->get_evento_by_id($id);

            //CASO USUARIO TENHA CLICADO EM REMOVER IMAGEM
            //recebe nome da imagem anterior salva no bd (ou NULL)
            $imagem_anterior = $evento['imagem'];
            //caso haja sinal de exclusao, exclui imagem anterior do server
            if($this->input->post('excluir_img') == "true"){
                unlink(FCPATH."assets/img/eventos/".$imagem_anterior);
                $imagem = NULL;
            }else{ //caso nao haja flag de exclusao, mantem imagem anterior
                $imagem = $imagem_anterior;
            }

            //CASO USUARIO TENHA ENVIADO NOVA IMAGEM
            if(file_exists($_FILES['imagem']['tmp_name'])){
                if(getimagesize($_FILES["imagem"]["tmp_name"]) > 0){
                    $ext = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
                    //especifica nome do arquivo com base na data e hora
                    $nova_imagem = date('Y-m-d H.i.s').'.'.$ext;
                    $caminho = FCPATH."assets/img/eventos/".$nova_imagem;
                    //salva imagem no servidor e recebe o nome dela para salvar no registro no bd
                    if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho)){
                        $imagem = $nova_imagem;
                        //exclui do server imagem anterior, caso haja
                        unlink(FCPATH."assets/img/eventos/".$imagem_anterior);
                    }
                }
            }
            //faz update no bd e recebe a nova url_amiga
            $nova_url_amiga = $this->eventos_model->update_eventos($id, $imagem);
            if($nova_url_amiga){
                $this->session->set_flashdata('sucesso', 'Evento editado com sucesso!');
            }
            redirect('eventos/'.$nova_url_amiga);
        }
    }


    public function categorias_ingressos($id){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('categoriasIngressos_model');
        //impede acesso caso nao seja admin
        $this->acesso->controlar();
        check_404($id);
        $data['evento'] = $this->eventos_model->get_evento_by_id($id);
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);
        check_404($data['evento']);

        $data['cat_ingressos'] = $this->categoriasIngressos_model->get_cat_ingressos_by_evento($id);
        //para cada categoria de ingresso formata o valor e calcula a qtd restante
        foreach($data['cat_ingressos'] as &$cat_ingresso){ //foreach usando referencia (&)
            $cat_ingresso['valor'] = formatar_moeda($cat_ingresso['valor'], true);
            $cat_ingresso['qtd_restante'] = $this->categoriasIngressos_model->get_qtd_ingressos($cat_ingresso['id']);
        }
        //carrega header, msgs de erro, eventos/categorias_ingressos e footer
        carregar_views($this, 'eventos/categorias_ingressos', $data);
    }


    public function atualizar_ingressos($id_evento){
        $this->load->model('categoriasIngressos_model');
        //impede acesso caso nao seja admin
        $this->acesso->controlar();
        check_404($id_evento);
        $data['evento'] = $this->eventos_model->get_evento_by_id($id_evento);
        check_404($data['evento']);
        //recebe todos os dados de input via post
        $data = $this->input->post();
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);

        //PARA CADA INPUT RECEBIDO VIA POST, VERIFICA SE EH RELACIONADO A UM INGRESSO
        //APOS, VERIFICA SE EH INGRESSO NOVO (INSERIR) OU INGRESSO JA EXISTENTE (UPDATE)
        foreach ($data as $input_key => $input_val) {
            //trata o nome do input
            $input_arr = explode("-", $input_key);
            //verifica se eh relacionado a um ingresso
            if($input_arr[0] == "ativo" ){
                //verifica se eh ingresso novo
                if($input_arr[1] == "novo"){
                    //INGRESSO NOVO (INSERIR)
                    $indice = $input_arr[2];
                    $novo_ingresso = array(
                        'id_evento' => $id_evento,
                        'titulo' => $data['titulo-novo-'.$indice],
                        'valor' => formatar_moeda( $data['valor-novo-'.$indice], false),
                        'qtd' => $data['qtd-novo-'.$indice],
                        'ativo' => 1
                    );
                    //insere ingresso novo no bd
                    if($this->categoriasIngressos_model->set_cat_ingressos($novo_ingresso)){
                        $this->session->set_flashdata('sucesso', 'Ingresso(s) salvo(s) com sucesso!');
                    }
                }else{
                    //INGRESSO JA EXISTENTE (UPDATE)
                    $id_ingresso = $input_arr[1];
                    if($data['ativo-'.$id_ingresso] == 0){ //somente desativa
                        $atualizar_ingresso = array(
                            'ativo' => $data['ativo-'.$id_ingresso]
                        );
                    }else{ //atualiza todos campos
                        $atualizar_ingresso = array(
                            'titulo' => $data['titulo-'.$id_ingresso],
                            'valor' => formatar_moeda($data['valor-'.$id_ingresso], false),
                            'qtd' => $data['qtd-'.$id_ingresso],
                            'ativo' => $data['ativo-'.$id_ingresso]
                        );
                    }
                    //atualiza ingresso no bd
                    if($this->categoriasIngressos_model->update_cat_ingressos($id_ingresso, $atualizar_ingresso)){
                        $this->session->set_flashdata('sucesso', 'Ingresso(s) atualizado(s) com sucesso!');
                    }
                }
            }
        }
        redirect('eventos');
    }


    public function ingressos($url_amiga = NULL){
        $this->load->model('categoriasIngressos_model');
        $this->load->model('inscricoes_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['evento'] = $this->eventos_model->get_eventos($url_amiga);
        //impede acesso caso nao seja usuario logado
        if(!$this->acesso->logged_user()){
            redirect('login');
        }
        check_404($url_amiga);
        check_404($data['evento']);
        //formata a data e hora do evento antes de exibir
        $data['evento']['data'] = formatar_data($data['evento']['data_hora'], true);
        $data['evento']['hora'] = formatar_hora($data['evento']['data_hora'], false);
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);

        $ingressos = $this->categoriasIngressos_model->get_cat_ingressos_by_evento($data['evento']['id']);
        if($ingressos){
            foreach($ingressos as &$ingresso){ //foreach usando referencia (&)
                $ingresso['valor'] = formatar_moeda($ingresso['valor'], true);
                $ingresso['qtd_restante'] = $ingresso['qtd']; //( TODO diminuir qtd de ingressos comprados)
            }
            $data['ingressos'] = $ingressos;
        }

        $this->form_validation->set_rules('nome', 'Nome do Inscrito', 'required');
        if ($this->form_validation->run() === FALSE){
            //carrega header, msgs de erro, eventos/ingressos e footer
            carregar_views($this, 'eventos/ingressos', $data);
        }else{
            if($this->inscricoes_model->set_inscricao()){
                $this->session->set_flashdata('sucesso', 'Ingresso adquirido com sucesso!');
            }
            redirect('eventos');
        }
    }


    public function deletar($id){
        //impede acesso caso nao seja admin
        $this->acesso->controlar();
        check_404($id);
        if($this->eventos_model->delete_evento($id)){
            $this->session->set_flashdata('sucesso', 'Evento excluído com sucesso!');
            redirect('eventos');
        }
    }


}
