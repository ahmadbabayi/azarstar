<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Temrin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('temrin_model');
        $this->load->model('member_model');
        $this->load->model('tools_model');
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('str_helper');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('temrin');
        $this->load->view('footer');
    }

    public function emptymyword() {
        $this->db->query('TRUNCATE TABLE mywords');
    }

    public function english() {
        $this->load->library('phonetic');
        //$this->phonetic->transcribe( 'word' );
        //transcribe( 'word' );
        $row = $this->temrin_model->show_english_words();
        /* foreach ($row as $value) {
          echo $value['word'].'<br>';
          }
         */
        echo $this->phonetic->transcribe('word');
    }

    public function phonetic() {
        //$this->phonetic->transcribe( 'word' );
        //transcribe( 'word' );
        $row = $this->temrin_model->show_words();
        foreach ($row as $value) {
            echo $value['m'] . '<br>';
            //$str = unicode_decode($value['m']);
            //$id = $value['id'];
            //entities2utf8
            // $this->db->query('UPDATE `mywords` SET `m`="'.$str.'" WHERE id = '.$id);
        }
    }

    public function body() {
        $row = $this->temrin_model->show_bodies();
        foreach ($row as $value) {
            $str = addslashes(html_entity_decode($value['body']));
            $id = $value['id'];

            $this->db->query('UPDATE `dict_bodies` SET `body`="' . $str . '" WHERE id = ' . $id);
        }
    }

    public function updatepronun() {
        $dict_id = 2;
        $word = $this->temrin_model->fetch_records($dict_id);
        foreach ($word as $value) {
            $myword = $this->temrin_model->show_my_word($value['word']);
            //echo $value['word'].'-'.$myword['m'].'<br>';
            // if ($myword['m']!=''){
            //$this->db->query('UPDATE `dict_words` SET `pronun`="['.$myword['m'].']" WHERE id = '.$value['id']);}
        }
    }

    public function words() {
        $dict_id = intval($this->uri->segment(3, 0));
        if ($dict_id == '') {
            redirect('temrin', 'location');
        }
        $row = $this->temrin_model->show_words();
        ini_set('max_execution_time', 300);
        $i = 0;
        foreach ($row as $value) {
            $word = $value['w'];
            $word_id = $this->member_model->search_word($word);
            if ($word_id == 0) {
                $word_id = $this->temrin_model->insert_word($word);
            }
            $is_freq = $this->member_model->search_word_id($word_id, $dict_id);
            $this->temrin_model->insert_entry($word_id, $dict_id, $is_freq, $value['m'], $value['p']);
            $this->db->query('UPDATE `mywords` SET `up`=1 WHERE id = ' . $value['id']);
            if ($i++ == 100)
                break;
        }
        echo '<script>
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}

window.onload = timedRefresh(3000);

//   -->
</script><h1>Finished!</h1>';
    }

    public function removewords() {
        $dict_id = intval($this->uri->segment(3, 0));
        if ($dict_id == '') {
            redirect('temrin', 'location');
        }
        $word = $this->temrin_model->fetch_records($dict_id);
        foreach ($word as $value) {
            $id = $value['id'];
            $this->db->query('delete from dict_words where id=' . $id);
            $this->db->query('delete from dict_bodies where id=' . $id);
        }
    }

    public function pronun() {
        $dict_id = intval($this->uri->segment(3, 0));
        if ($dict_id == '') {
            redirect('temrin', 'location');
        }
        $word = $this->temrin_model->fetch_records($dict_id);
        $j = 0;
        foreach ($word as $value) {
            $id = $value['id'];
            $str = $value['body'];
            $pronun = $value['pronun'];
            $str_sub = mb_substr($str, 1, 2);
            if ($str_sub == ',[') {
                $memolist = preg_split('/[\s]+/', $str);

                for ($i = 0; $i < count($memolist); $i++) {
                    $pr2 = $memolist[1];
                    $pr2 = str_replace(',[', ', [', $pr2);
                    $pr = $pronun.$pr2;
                    echo $pr . '<br>';
                    $this->db->query('UPDATE `dict_words` SET `pronun`="' . $pr . '" WHERE id = ' . $id);
                    $memolist[1] = '';
                    break;
                }
                $str = implode(' ', $memolist);
                $this->db->query('UPDATE `dict_bodies` SET `body`="' . $str . '" WHERE id = ' . $id);
                echo $str . '<br>';
                if ($j++ == 50)
                break;
            }
        }
        echo '<script>
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}

window.onload = timedRefresh(3000);

//   -->
</script><h1>Finished!</h1>';
    }

    public function convert() {
        $this->load->helper('str_helper');
        $word = $this->temrin_model->fetch_records(2);
        ini_set('max_execution_time', 300);
        foreach ($word as $value) {
            $memo1 = $value['body'];
            $wordslist = $this->tools_model->get_words_list();
            $data['wordcount'] = $this->tools_model->words_count();
            mb_internal_encoding("utf-8");

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
                    $memolist[$i] = strreplace($memolist[$i]);
                }
            }
            $memo2 = implode(' ', $memolist);
            $memo2 = lastconvert($memo2);
            $memo2 = addslashes($memo2);
            $w = addslashes($value['word']);
            $p = addslashes($value['pronun']);
            $this->db->query("INSERT INTO `mywords`(`w`, `m`, `p`) VALUES ('$w','$memo2','$p')");
        }
    }

    public function separate() {
        if (!($file = fopen("data/z123z.txt", "r"))) {
            echo 'error';
        }

        while (!feof($file)) {
            $str = fgets($file);
            if (strpos($str, '[') == false) {
                echo $str . '<br>';
            }
        }

        fclose($file);
    }

    public function separate2() {
        if (!($file = fopen("data/z123zpart2.txt", "r"))) {
            echo 'error';
        }

        while (!feof($file)) {
            $str = fgets($file);
            $memolist = preg_split('/[\s]+/', $str);
            $w = FALSE;

            for ($i = 0; $i < count($memolist); $i++) {
                if (isarabicword($memolist[$i])) {
                    if (!$w) {
                        $memolist[$i] = '@@' . $memolist[$i];
                    }
                    $w = TRUE;
                }
            }
            $str = implode(' ', $memolist);
            echo $str . '<br>';
        }

        fclose($file);
    }

    public function separate3() {
        if (!($file = fopen("data/zz3.sql", "r"))) {
            echo 'error';
        }

        while (!feof($file)) {
            $str = fgets($file);
            $memolist = preg_split('/[\s]+/', $str);
            $w = FALSE;

            for ($i = 0; $i < count($memolist); $i++) {
                if (ispronun($memolist[$i])) {
                    if (!$w) {
                        $memolist[$i] = '@@' . $memolist[$i];
                        $memolist[$i] = $memolist[$i] . '@@';
                    }
                    $w = TRUE;
                }
            }
            $str = implode(' ', $memolist);
            echo $str . '<br>';
        }

        fclose($file);
    }

}
