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

        $this->db->select('i.*, ci.titulo AS titulo_ingresso, ci.valor, e.titulo AS titulo_evento');
        $this->db->from('inscricoes AS i');
        $this->db->join('categorias_ingressos AS ci', 'ci.id = i.id_ingresso', 'inner');
        $this->db->join('eventos AS e', 'ci.id_evento = e.id', 'inner');
        $this->db->where(array('i.id_usuario' => $id_usuario));
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_inscricoes_by_evento($id_evento)
    {
        $this->db->select('i.*, ci.titulo AS titulo_ingresso, ci.valor');
        $this->db->from('inscricoes AS i');
        $this->db->join('categorias_ingressos AS ci', 'ci.id = i.id_ingresso', 'inner');
        $this->db->join('eventos AS e', 'ci.id_evento = e.id', 'inner');
        $this->db->where(array('e.id' => $id_evento));
        $query = $this->db->get();

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
