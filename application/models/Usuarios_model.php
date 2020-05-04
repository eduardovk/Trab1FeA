<?php
class Usuarios_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_usuario($email, $senha)
    {
        $query = $this->db->get_where('usuarios', array('email' => $email, 'senha' => $senha));
        return $query->row_array();
    }

    public function get_usuario_email($email){
        $query = $this->db->get_where('usuarios', array('email' => $email));
        return $query->row_array();
    }

    public function set_usuario()
    {
        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'cpf' => $this->input->post('cpf'),
            'senha' => sha1($this->input->post('senha')),
            'admin' => 0
        );
        return $this->db->insert('usuarios', $data);
    }
}
