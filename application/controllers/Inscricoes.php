<?php
class Inscricoes extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('inscricoes_model');
        $this->load->helper('url_helper');
    }

    
    public function index(){
        //impede acesso se nao for usuario logado
        if(!$this->acesso->logged_user()){
            redirect('login');
        }
        $id_usuario = $this->session->userdata("id_usuario");
        $data['inscricoes'] = $this->inscricoes_model->get_inscricoes_by_usuario($id_usuario);
        //para cada inscricao, formata valor e registro de pago
        foreach($data['inscricoes'] as &$inscricao){
            $inscricao['valor'] = formatar_moeda($inscricao['valor'], true);
            if($inscricao['pago'] == 1){
                $inscricao['pago'] = "Sim";
            }else{
                $inscricao['pago'] = "Não";
            }
        }
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);
        //carrega header, msgs de erro, inscricoes/index e footer
        carregar_views($this, 'inscricoes/index', $data);
    }


    public function inscricoes_evento($id_evento){
        $this->load->model('eventos_model');
        //impede acesso se nao for admin
        $this->acesso->controlar();
        $data['inscricoes'] = $this->inscricoes_model->get_inscricoes_by_evento($id_evento);
        $data['evento'] = $this->eventos_model->get_evento_by_id($id_evento);
        //formata data e hora antes de exibir
        $data['evento']['data'] = formatar_data($data['evento']['data_hora'], true);
        $data['evento']['hora'] = formatar_hora($data['evento']['data_hora'], false);
        //para cada inscricao, formata valor e registro de pago
        foreach($data['inscricoes'] as &$inscricao){
            $inscricao['valor'] = formatar_moeda($inscricao['valor'], true);
            if($inscricao['pago'] == 1){
                $inscricao['pago'] = "Sim";
            }else{
                $inscricao['pago'] = "Não";
            }
        }
        //capturar nome do usuario e nivel de acesso (caso logado)
        identificar_usuario($this, $data);
        //carrega header, msgs de erro, inscricoes/inscricoes_evento e footer
        carregar_views($this, 'inscricoes/inscricoes_evento', $data);
    }


}
