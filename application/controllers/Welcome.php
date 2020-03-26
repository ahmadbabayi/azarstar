<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('main_model');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->library('form_validation');
        $this->load->helper('filter_helper');
    }

    public function index() {
        $data['items'] = $this->main_model->show_dicts();
        $this->load->view('header');
        if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {
            $this->load->view('dict/member/main');
        }
        $this->load->view('welcome_message',$data);
        $this->load->view('footer');
    }
}