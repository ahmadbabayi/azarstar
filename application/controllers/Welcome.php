<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['items'] = $this->main_model->show_dicts();
        $this->load->view('header');
        $this->load->view('welcome_message',$data);
        $this->load->view('footer');
    }
}