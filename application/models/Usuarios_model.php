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

    public function set_usuario()
    {

        //TODO USUARIO

        //return $this->db->insert('news', $data);
    }
}
