<?php

class Member_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('pagination');
    }

    public function show_dicts() {
        $query = $this->db->get('dict_names');
        return $query->result_array();
    }

    public function show_dict($id) {
        $this->db->from('dict_names');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function show_dict_preamble($id) {
        $this->db->from('dict_preamble');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function show_words($id,$char) {
        $this->db->select('words.*, dict_words.*, dict_bodies.body');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->join('dict_bodies', 'dict_bodies.id = dict_words.id', 'left');
        $this->db->order_by('words.word', 'ASC');
        $this->db->where('dict_words.dict_id', $id);
        $this->db->like('words.word', $char, 'after');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user($user_id) {

        $this->db->from('users');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();
    }

    public function update_dict() {
        $id = $this->input->post('id');
        $this->title = $this->input->post('title');
        $this->author = $this->input->post('author');
        $this->direction = $this->input->post('direction');
        $this->description = $this->input->post('description');
        $this->alphabet = $this->input->post('alphabet');
        $this->db->update('dict_names', $this, array('id' => $id));
        
        unset($this->title);
        unset($this->author);
        unset($this->direction);
        unset($this->description);
        unset($this->alphabet);
        
        $this->thanks = $this->input->post('thanks');
        $this->identity = addslashes(html_entity_decode($this->input->post('identity')));
        $this->identity2 = addslashes(html_entity_decode($this->input->post('identity2')));
        $this->preamble = addslashes(html_entity_decode($this->input->post('preamble')));
        $this->db->update('dict_preamble', $this, array('id' => $id));
        
    }

    public function insert_dict() {
        $this->title = $this->input->post('title');
        $this->author = $this->input->post('author');
        $this->direction = $this->input->post('direction');
        $this->description = $this->input->post('description');
        $this->alphabet = $this->input->post('alphabet');

        $this->db->insert('dict_names', $this);
        unset($this->title);
        unset($this->author);
        unset($this->direction);
        unset($this->description);
        unset($this->alphabet);
        
        $this->id = $this->db->insert_id();
        $this->db->insert('dict_preamble', $this);
    }

    public function insert_entry($word_id,$dict_id,$freq) {
        $this->dict_id = $dict_id;
        $this->word_id = $word_id;
        $this->pronun = $this->input->post('pronun');
        $this->freq = $freq;

        $this->db->insert('dict_words', $this);
        
        unset($this->word_id);
        unset($this->dict_id);
        unset($this->pronun);
        unset($this->freq);
        
        $this->id = $this->db->insert_id();
        $this->body = addslashes(html_entity_decode($this->input->post('etymology')));
        $this->db->insert('dict_bodies', $this);
    }
    
    public function update_entry($id,$word_id,$dict_id,$freq) {
        $this->dict_id = $dict_id;
        $this->word_id = $word_id;
        $this->pronun = $this->input->post('pronun');
        $this->freq = $freq;
        
        $this->db->update('dict_words', $this, array('id' => $id));
        
        unset($this->word_id);
        unset($this->dict_id);
        unset($this->pronun);
        unset($this->freq);
        
        $this->id = $id;
        $this->body = addslashes(html_entity_decode($this->input->post('etymology')));
        $this->db->update('dict_bodies', $this,array('id' => $id));
    }

    public function search_word($word) {
        $query = $this->db->query('SELECT id FROM words WHERE BINARY word = "'.$word.'"');
        $row = $query->row();
        if ($query->num_rows()>0) {
            return $row->id;
        } else {
            return 0;
        }
    }
    
    public function search_word_id($word_id,$dict_id) {
        $this->db->select('id');
        $this->db->where('word_id', $word_id);
        $this->db->where('dict_id', $dict_id);
        $query = $this->db->get('dict_words');
        if ($query->num_rows()>0) {
            $freq = $query->num_rows()+1;
            return $freq;
        } else {
            return 0;
        }
    }

    public function insert_word() {
        $this->word = $this->input->post('word');
        $this->db->insert('words', $this);
        unset($this->word);
        return $this->db->insert_id();
    }
    
    public function show_last_word($dict_id) {
        $this->db->select('*');
         $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->join('dict_bodies', 'dict_bodies.id = dict_words.id', 'left');
        $this->db->where('dict_words.dict_id', $dict_id);
        $this->db->order_by('dict_words.id','DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function show_word($id) {
        $this->db->select('*');
         $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->join('dict_bodies', 'dict_bodies.id = dict_words.id', 'left');
        $this->db->where('dict_words.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
     public function show_profile($id) {

        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array();
    }

    public function update_profile() {

        $this->email = $this->input->post('email');
        $this->password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
        $id = $this->input->post('id');

        $this->db->update('users', $this, array('id' => $id));
    }

}
