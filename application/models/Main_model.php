<?php

class Main_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function show_dicts() {
        $query = $this->db->get('dict_names');
        return $query->result_array();
    }

    public function get_user($user_id) {

        $this->db->from('users');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();
    }

}
