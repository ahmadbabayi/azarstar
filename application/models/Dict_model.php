<?php

class Dict_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function record_count($id, $char) {
        $this->db->where('dict_words.dict_id', $id);
        $this->db->from('dict_words');
        if ($char != '') {
            $this->db->join('words', 'words.id = dict_words.word_id');
            $this->db->where('dict_words.dict_id', $id);
            $this->db->like('words.word', $char, 'after');
        }
        return $this->db->count_all_results();
    }

    public function fetch_records($id, $char, $limit, $start) {
        $this->db->select('*');
        $this->db->limit($limit, $start);
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->join('dict_bodies', 'dict_bodies.id = dict_words.id', 'left');
        $this->db->order_by('words.word', 'ASC');
        $this->db->where('dict_words.dict_id', $id);
        if ($char != '') {
            $this->db->like('words.word', $char, 'after');
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function search_records($char,$dict_id) {
        $this->db->select('words.*, dict_words.*');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->order_by('words.word', 'ASC');
        if ($dict_id !=''){
            $this->db->where('dict_words.dict_id', $dict_id);
        }
        $this->db->like('words.word', $char, 'after');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function search_records2($char,$dict_id) {
        $this->db->select('words.*, dict_words.*, dict_names.title');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->join('dict_names', 'dict_names.id = dict_words.dict_id', 'left');
        $this->db->order_by('words.word', 'ASC');
        if ($dict_id !=''){
            $this->db->where('dict_words.dict_id', $dict_id);
        }
        $this->db->like('words.word', $char, 'after');
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    public function show_word($id) {
        $this->db->select('dict_names.title,dict_names.direction,dict_bodies.body,words.word,dict_words.*');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->join('dict_bodies', 'dict_bodies.id = dict_words.id', 'left');
        $this->db->join('dict_names', 'dict_names.id = dict_words.dict_id', 'left');
        $this->db->where('dict_words.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function show_next_word($id,$dict_id) {
        $this->db->select_min('dict_words.id');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->order_by('words.word', 'ASC');
        $this->db->where('dict_words.dict_id', $dict_id);
        $this->db->where('dict_words.id >', $id);
        $query = $this->db->get();
        $row = $query->row();
        $id = $row->id;
        $this->db->select('words.word,dict_words.id');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->where('dict_words.dict_id', $dict_id);
        $this->db->where('dict_words.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function show_pre_word($id,$dict_id) {
        $this->db->select_max('dict_words.id');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->order_by('words.word', 'ASC');
        $this->db->where('dict_words.dict_id', $dict_id);
        $this->db->where('dict_words.id <', $id);
        $query = $this->db->get();
        $row = $query->row();
        $id = $row->id;
        $this->db->select('words.word,dict_words.id');
        $this->db->from('dict_words');
        $this->db->join('words', 'words.id = dict_words.word_id', 'left');
        $this->db->where('dict_words.dict_id', $dict_id);
        $this->db->where('dict_words.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function show_dict($id) {
        $this->db->select('*');
        $this->db->from('dict_names');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function show_dicts() {
        $query = $this->db->get('dict_names');
        return $query->result_array();
    }

    public function update_dict() {
        $id = $this->input->post('id');
        $this->title = $this->input->post('title');
        $this->author = $this->input->post('author');
        $this->description = $this->input->post('description');
        $this->alphabet = $this->input->post('alphabet');
        $this->db->update('dict_names', $this, array('id' => $id));
    }

    public function insert_dict() {
        $this->title = $this->input->post('title');
        $this->author = $this->input->post('author');
        $this->description = $this->input->post('description');
        $this->alphabet = $this->input->post('alphabet');

        $this->db->insert('dict_names', $this);
    }

}
