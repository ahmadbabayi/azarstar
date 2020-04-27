<?php
class Temrin_model extends CI_Model {
    
    public function __construct() {
        $this->load->helper('unicode_helper');
        
    }

    public function show_items() {
        $query = $this->db->get('items');
        return $query->result_array();
    }
    
    public function show_english_words() {
        $this->db->select('*');
        $this->db->limit(500);
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->join('dict_bodies', 'dict_bodies.id = dict_words.id', 'left');
        $this->db->order_by('words.word', 'ASC');
        $this->db->where('dict_words.dict_id', 2);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function show_words() {
        $this->db->order_by('w','ASC');
        $this->db->where('up', 0);
        $query = $this->db->get('mywords');
        return $query->result_array();
    }
    
    public function show_bodies() {
        $query = $this->db->get('dict_bodies');
        return $query->result_array();
    }
    
    public function show_table() {
        $this->db->order_by('latin','DESC');
        $query = $this->db->get('convert_words');
        return $query->result_array();
    }
    
    public function show_my_word($word) {
        $this->db->select('*');
        $this->db->from('mywords');
        $this->db->where('w', $word);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function insert_word($word) {
        $this->word = $word;
        $this->db->insert('words', $this);
        unset($this->word);
        return $this->db->insert_id();
    }
    
    public function insert_entry($word_id,$dict_id,$freq,$m,$p) {
        $p = addslashes($p);
        $this->db->query("INSERT INTO `dict_words`(`dict_id`, `word_id`, `pronun`, `speachpart`, `deriv`, `freq`, `date_insert`, `date_update`) VALUES ($dict_id,$word_id,'$p','','',$freq,'','')");
        $id = $this->db->insert_id();
         $body = addslashes($m);
        $this->db->query("INSERT INTO `dict_bodies`(`id`, `body`) VALUES ($id,'$body')");
    }

    public function show_corrects() {
        $query = $this->db->get('words');
        return $query->result_array();
    }
    
    public function show_body() {
        $query = $this->db->get('dict_words');
        return $query->result_array();
    }
    
    public function update_body($id) {
        $this->body_id = $id;
        $this->db->update('dict_words', $this, array('id' => $id));
    }
    
    public function fetch_records($id) {
        $this->db->select('dict_words.*,words.word,dict_bodies.body');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->join('dict_bodies', 'dict_bodies.id = dict_words.id', 'left');
        $this->db->order_by('words.word', 'ASC');
        $this->db->where('dict_words.dict_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
