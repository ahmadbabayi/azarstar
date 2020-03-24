<?php

class Dict extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dict_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->helper('str_helper');
    }

    public function index() {
        $id = intval($this->uri->segment(3, 0));
        $data['row'] = $this->dict_model->show_dict($id);

        $start = $this->uri->segment(4, 0);
        $limit = $this->config->item('per_page');
        $data['items'] = $this->dict_model->fetch_records($id, $limit, $start);

        $config['base_url'] = site_url() . '/dict/index/' . $id;
        $config['total_rows'] = $this->dict_model->record_count($id);
        $config['per_page'] = $this->config->item('per_page');
        $config['cur_tag_open'] = '';
        $config['cur_tag_close'] = '';
        $config['attributes'] = array('class' => 'w3-button');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('dict/main', $data);
        $this->load->view('footer');
    }

    public function show() {
        $id = intval($this->uri->segment(3, 0));
        $data['row'] = $this->dict_model->show_dict($id);

        $start = $this->uri->segment(4, 0);
        $limit = $this->config->item('per_page');
        $data['items'] = $this->dict_model->fetch_records($id, '', $limit, $start);

        $config['base_url'] = site_url() . '/dict/show/' . $id;
        $config['total_rows'] = $this->dict_model->record_count($id, '');
        $config['per_page'] = $this->config->item('per_page');
        $config['attributes'] = array('class' => 'w3-button');
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('header');
        if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {
            $this->load->view('dict/member/dict', $data);
        }
        $this->load->view('dict/show', $data);
        $this->load->view('footer');
    }

    public function showchar() {
        $id = intval($this->uri->segment(3, 0));
        $char = $this->uri->segment(4, 0);
        $char = urldecode($char);
        $data['row'] = $this->dict_model->show_dict($id);

        $start = $this->uri->segment(5, 0);
        $limit = $this->config->item('per_page');
        $data['items'] = $this->dict_model->fetch_records($id, $char, $limit, $start);

        $config['base_url'] = site_url() . '/dict/showchar/' . $id . '/' . $char;
        $config['total_rows'] = $this->dict_model->record_count($id, $char);
        $config['per_page'] = $this->config->item('per_page');
        $config['attributes'] = array('class' => 'w3-button');
        $this->pagination->initialize($config);

        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('header');
        if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {
            $this->load->view('dict/member/dict', $data);
        }
        $this->load->view('dict/show', $data);
        $this->load->view('footer');
    }

    public function search() {
        $this->load->view('header');
        $this->load->view('dict/searchheader');
        $dict_id = intval($this->uri->segment(3, 0));
        if ($this->uri->segment(4, 0) == '') {
            $char = $this->input->post('q');
        } else {
            $char = $this->uri->segment(4, 0);
            $char = urldecode($char);
        }
        if ($dict_id == '' && $char != '') {
            $dicts = $this->dict_model->show_dicts();
            foreach ($dicts as $value) {
                $data['dict_id'] = $value['id'];
                $data['dict_title'] = $value['title'];
                $data['items'] = $this->dict_model->search_records($char, $value['id']);
                if ($data['items']!= FALSE){
                    $this->load->view('dict/search', $data);
                }
            }
        } else {
            $data['dict_id'] = $dict_id;
            if ($char != '') {
                $dict_title = $this->dict_model->show_dict($dict_id);
                $data['dict_title'] = $dict_title['title'];
                $data['items'] = $this->dict_model->search_records($char, $dict_id);
                $this->load->view('dict/search', $data);
            }
        }

        $this->load->view('footer');
    }

    public function word() {
        $id = intval($this->uri->segment(3, 0));
        $row = $this->dict_model->show_word($id);
        $data['row'] = $row;
        $data['next'] = $this->dict_model->show_next_word($id, $row['dict_id']);
        $data['pre'] = $this->dict_model->show_pre_word($id, $row['dict_id']);


        $this->load->view('header');
        if (isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {
            $this->load->view('dict/member/entry_edit', $data);
        }
        $this->load->view('dict/word', $data);
        $this->load->view('footer');
    }

}