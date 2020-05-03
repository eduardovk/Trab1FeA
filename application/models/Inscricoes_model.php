<?php
class Inscricoes_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_inscricoes($id = FALSE)
    {
        if ($id === FALSE)
        {
            $query = $this->db->get('inscricoes');
            return $query->result_array();
        }

        $query = $this->db->get_where('inscricoes', array('id' => $id));
        return $query->row_array();
    }

    public function get_inscricoes_by_usuario($id_usuario)
    {
        $query = $this->db->get_where('inscricoes', array('id_usuario' => $id_usuario));
        return $query->result_array();
    }

    public function get_inscricoes_by_evento($id_evento)
    {
        $query = $this->db->get_where('inscricoes', array('id_evento' => $id_evento));
        return $query->result_array();
    }

    public function set_inscricao()
    {
        $data = array(
            'id_usuario' => $this->session->userdata("id_usuario"),
            'id_ingresso' => $this->input->post('ingresso'),
            'nome' => $this->input->post('nome'),
            'pago' => 0
        );
        return $this->db->insert('inscricoes', $data);
    }
}
