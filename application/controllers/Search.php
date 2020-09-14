<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('items_model');
        $this->load->helper('url');
        $this->load->helper('file');
    }

    public function index() {
        $data['items'] = $this->items_model->show_words();
        $this->load->view('search',$data);
    }

    public function words() {
        $data['items'] = $this->items_model->show_words();
        $this->load->view('search',$data);
    }
    
    public function word() {
        $data['items'] = $this->items_model->show_words();
        $this->load->view('search',$data);
    }
    
}
