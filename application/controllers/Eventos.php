<?php
class Eventos extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('eventos_model');
        $this->load->helper('url_helper');
    }

}
