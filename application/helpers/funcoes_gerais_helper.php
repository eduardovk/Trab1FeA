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
