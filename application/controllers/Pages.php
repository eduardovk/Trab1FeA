<?php
class Pages extends CI_Controller
{

    public function view($page = 'eventos'){
        if($page != 'eventos'){
            if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php')){
                // Whoops, we don't have a page for that!
                show_404();
            }
            $data = array();
            //capturar nome do usuario e nivel de acesso (caso logado)
            identificar_usuario($this, $data);
            //carrega header, msgs de erro, eventos/index e footer
            carregar_views($this, 'pages/'.$page, $data);
        }else{
            redirect('eventos');
        }
    }

}
