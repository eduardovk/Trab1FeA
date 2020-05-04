<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('formatar_moeda')){
    function formatar_moeda($valor, $padrao_br){
        if($padrao_br){
            $valor = str_replace(',', '-', $valor);
            $valor = str_replace('.', ',', $valor);
            $valor = str_replace('-', '.', $valor);
        }else{
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
        }
        return $valor;
    }
}

if ( ! function_exists('formatar_data')){
    function formatar_data($data, $padrao_br){
        if($padrao_br){
            $data = date('d/m/Y', strtotime($data));
        }else{
            $data = date('Y/m/d', strtotime($data));
        }
        return $data;
    }
}

if ( ! function_exists('formatar_hora')){
    function formatar_hora($hora, $segundos){
        if($segundos){
            $hora = date('H:i:s', strtotime($hora));
        }else{
            $hora = date('H:i', strtotime($hora));
        }
        return $hora;
    }
}

if ( ! function_exists('checar_mensagens')){
    function checar_mensagens($instancia){
        $data['erro'] = $instancia->session->flashdata('erro');
        $data['sucesso'] = $instancia->session->flashdata('sucesso');
        $instancia->load->view('templates/msg_erro', $data);
        $instancia->load->view('templates/msg_sucesso', $data);
    }
}
