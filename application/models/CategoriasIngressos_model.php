<?php
class CategoriasIngressos_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_cat_ingressos($id_cat_ingresso){
        if ($id_cat_ingresso === FALSE)
        {
            //$query = $this->db->get('categorias_ingressos');
            $query = $this->db->get_where('categorias_ingressos', array('ativo' => '1'));
            return $query->result_array();
        }

        $query = $this->db->get_where('categorias_ingressos', array('id' => $id_cat_ingresso, 'ativo' => '1'));
        return $query->row_array();
    }

    public function get_cat_ingressos_by_evento($id_evento){
        $query = $this->db->get_where('categorias_ingressos', array('id_evento' => $id_evento, 'ativo' => '1'));
        return $query->result_array();
    }

    public function get_qtd_ingressos($id_ingresso){
        $query = $this->db->get_where('inscricoes', array('id_ingresso' => $id_ingresso));
        $qtd_vendida = $query->num_rows();

        $query = $this->db->get_where('categorias_ingressos', array('id' => $id_ingresso));
        $qtd_total = $query->row_array()['qtd'];

        $qtd_restante = $qtd_total - $qtd_vendida;

        return $qtd_restante;
    }

    public function set_cat_ingressos($data){
        return $this->db->insert('categorias_ingressos', $data);
    }

    public function update_cat_ingressos($id_cat_ingresso, $data){
        return $this->db->update('categorias_ingressos', $data, 'id='.$id_cat_ingresso);
    }

}
