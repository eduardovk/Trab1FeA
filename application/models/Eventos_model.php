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

    public function get_evento_by_id($id){
        $query = $this->db->get_where('eventos', array('id' => $id));
        return $query->row_array();
    }

    public function set_eventos($imagem)
    {
        $this->load->helper('url');

        $url_amiga = url_title($this->input->post('titulo'), 'dash', TRUE);

        $data = array(
            'titulo' => $this->input->post('titulo'),
            'descricao' => $this->input->post('descricao'),
            'data_hora' => date('Y-m-d H:i:s'),
            'local' => $this->input->post('local'),
            'imagem' => $imagem,
            'url_amiga' => $url_amiga,
            'id_usuario' => $this->session->userdata("id_usuario"),
            'ativo' => 1
        );

        return $this->db->insert('eventos', $data);
    }

    public function update_eventos($id, $imagem){
        $this->load->helper('url');

        $url_amiga = url_title($this->input->post('titulo'), 'dash', TRUE);

        $data = array(
            'titulo' => $this->input->post('titulo'),
            'descricao' => $this->input->post('descricao'),
            'local' => $this->input->post('local'),
            'imagem' => $imagem,
            'url_amiga' => $url_amiga,
        );
        $this->db->update('eventos', $data, 'id='.$id);
        return $url_amiga;
    }

    public function delete_evento($id){
        $evento = $this->get_evento_by_id($id);
        $imagem = $evento['imagem'];

        if(!empty($imagem)){
            unlink(FCPATH."assets/img/eventos/".$imagem);
        }

        return $this->db->delete('eventos', array('id' => $id));
    }
}
