<?php
class Eventos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_eventos($url_amiga = FALSE)
    {
        if ($url_amiga === FALSE)
        {
            $query = $this->db->get('eventos');
            return $query->result_array();
        }

        $query = $this->db->get_where('eventos', array('url_amiga' => $url_amiga));
        return $query->row_array();
    }

    public function set_eventos()
    {
        $this->load->helper('url');

        $url_amiga = url_title($this->input->post('titulo'), 'dash', TRUE);

        $data = array(
            'titulo' => $this->input->post('titulo'),
            'descricao' => $this->input->post('descricao'),
            'data_hora' => date('Y-m-d H:i:s'),
            'local' => $this->input->post('local'),
            'url_amiga' => $url_amiga,
            'id_usuario' => 1, //TODO capturar id do usuario logado
            'ativo' => 1
        );

        return $this->db->insert('eventos', $data);
    }
}
