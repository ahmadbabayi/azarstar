<?php

class Tools_model extends CI_Model {

    public function __construct() {
        
    }

    public function get_words_list() {
        $query = $this->db->get('convert_words');
        return $query->result_array();
    }

    public function insert_word($latin, $arab) {
        $this->latin = mb_strtolower($latin);
        $this->arab = $arab;
        $this->db->insert('convert_words', $this);
    }
    public function words_count() {
        return $this->db->count_all_results('convert_words');
    }
    public function update_word($latin, $arab) {
        $this->latin = $latin;
        $this->arab = $arab;
        $this->db->update('convert_words', $this, array('latin' => $latin));
    }
    public function search_word($latin) {
        $this->db->select('id');
        $this->db->where('latin', $latin);
        $query = $this->db->get('convert_words');
        return $query->num_rows();
    }

}
