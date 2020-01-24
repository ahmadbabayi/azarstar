<?php

class Downloads extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('download');
    }
    
    public function index() {
        $this->load->view('header');
        $this->load->view('downloads/main');
        $this->load->view('footer');
    }
}
