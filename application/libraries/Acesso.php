<?php

class Acesso{
    public function controlar(){
        $CI = get_instance();
        $admin = $CI->session->userdata("admin");
        if(empty($admin) || $admin == 0){
            redirect("login");
        }
    }

    public function logged_user(){
        $CI = get_instance();
        $usuario = $CI->session->userdata("nome");
        if(!empty($usuario)){
            return $usuario;
        }
        return false;
    }

    public function is_admin(){
        $CI = get_instance();
        $admin = $CI->session->userdata("admin");
        if(!empty($admin) && $admin == 1){
            return true;
        }
        return false;
    }

}
