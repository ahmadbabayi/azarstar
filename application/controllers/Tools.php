<?php

class Tools extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tools_model');
    }
    
    public function index() {
        $this->load->view('header');
        $this->load->view('tools/main');
        $this->load->view('footer');
    }

    public function la2arconvert() {
        $this->load->helper('str_helper');
        $this->load->library('form_validation');
        if (!(isset($_SESSION['username']) && $_SESSION['logged_in'] === true)) {
            $data['login'] = FALSE;
        } else {
            $data['login'] = TRUE;
        }
        $wordslist = $this->tools_model->get_words_list();
        $data['wordcount'] = $this->tools_model->words_count();
        mb_internal_encoding("utf-8");

        $memo1 = $this->input->post('latin');

        if (mb_stripos($memo1, 'à') !== FALSE || mb_stripos($memo1, 'å') !== FALSE || mb_stripos($memo1, 'è') !== FALSE || mb_stripos($memo1, 'î') !== FALSE || mb_stripos($memo1, 'ÿ') !== FALSE || mb_stripos($memo1, 'þ') !== FALSE) {
            $memo1 = vajaqconvert($memo1);
        }

        $memo2 = trim($memo1);
        $memo2 = firstconvert($memo2);
        $memo2 = mb_strtolower($memo2);


        $memolist = preg_split('/[\s]+/', $memo2);

        for ($i = 0; $i < count($memolist); $i++) {
            if (convertableword($memolist[$i])) {
                $memolist[$i] = firstwordconvert($memolist[$i], $wordslist);
                $memolist[$i] = firstcharacter($memolist[$i]);
                $memolist[$i] = middleconvert($memolist[$i]);
                $memolist[$i] = strreplace($memolist[$i]);
            }
        }
        $memo2 = implode(' ', $memolist);
        $memo2 = lastconvert($memo2);
        $data['memo1'] = $memo1;
        $data['memo2'] = $memo2;

        $this->load->view('header');
        if ($data['login']) {
            $this->load->view('tools/wordajaxadd');
        }
        $this->load->view('tools/form', $data);
        $this->load->view('footer');
    }

    public function wordadd() {
        $latin = htmlspecialchars(strip_tags(urldecode($this->uri->segment(3, 0))));
        $latin = str_replace('ә', 'ə', $latin);
        $arab = htmlspecialchars(strip_tags(urldecode($this->uri->segment(4, 0))));
        if ($latin != '0' && $arab != '0' && isset($_SESSION['username']) && $_SESSION['logged_in'] === true) {
            $numrows = $this->tools_model->search_word($latin);
            if ($numrows > 0) {
                $this->tools_model->update_word($latin, $arab);
            } else {
                $this->tools_model->insert_word($latin, $arab);
            }
        }
    }

}
