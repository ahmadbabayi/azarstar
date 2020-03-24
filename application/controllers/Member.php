<?php

class Member extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('member_model');
        $this->load->model('dict_model');
        $this->load->library('form_validation');
        if (!(isset($_SESSION['username']) && $_SESSION['logged_in'] === true)) {
            redirect('user/login', 'location');
        }
    }

    public function index() {
        $data['items'] = $this->member_model->show_dicts();
        $this->load->view('header');
        
        $this->load->view('member/main', $data);
        $this->load->view('footer');
    }

    public function dictionary() {
        $id = intval($this->uri->segment(3, 0));
        $data['row'] = $this->member_model->show_dict($id);

        $start = $this->uri->segment(4, 0);
        $limit = $this->config->item('per_page');
        $data['items'] = $this->dict_model->fetch_records($id, '', $limit, $start);

        $config['base_url'] = site_url() . '/member/dictionary/' . $id;
        $config['total_rows'] = $this->dict_model->record_count($id, '');
        $config['per_page'] = $this->config->item('per_page');
        $config['attributes'] = array('class' => 'w3-button');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('header');
        $this->load->view('member/dict', $data);
        $this->load->view('footer');
    }

    public function search() {
        $dict_id = intval($this->uri->segment(3, 0));
        if ($this->uri->segment(4, 0) == '') {
            $char = $this->input->post('q');
        } else {
            $char = $this->uri->segment(4, 0);
            $char = urldecode($char);
        }
        $data['row'] = $this->member_model->show_dict($dict_id);
        $this->load->view('header');
        if ($char != ''){
        $data['items'] = $this->dict_model->search_records($char,$dict_id);
        $this->load->view('member/search', $data);
        }
        $this->load->view('footer');
    }

    public function dict_edit() {
        $id = intval($this->uri->segment(3, 0));
        if ($id == '') {
            redirect('', 'location');
        }
        $data['row'] = $this->member_model->show_dict($id);
        $data['row2'] = $this->member_model->show_dict_preamble($id);


        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('direction', 'Direction', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('member/dict_edit', $data);
            $this->load->view('footer');
        } else {
            $this->member_model->update_dict();
            //redirect('admin/test1/', 'location');
            redirect('dict/show/' . $id, 'location');
        }
    }

    public function dictionaryadd() {
        $this->form_validation->set_rules('title', 'Title', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('member/dictinsert');
            $this->load->view('footer');
        } else {
            $this->member_model->insert_dict();
            //redirect('admin/test1/', 'location');
            redirect('', 'location');
        }
    }

    public function entry() {
        if ($this->uri->segment(3, 0) == '') {
            $dict_id = $this->input->post('dict_id');
        } else {
            $dict_id = $this->uri->segment(3, 0);
        }
        if ($dict_id == '') {
            redirect('', 'location');
        }
        $data['dict'] = $this->member_model->show_dict($dict_id);
        $data['dict_id'] = $dict_id;
        $data['row'] = $this->member_model->show_last_word($dict_id);

        $this->form_validation->set_rules('word', 'word', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('member/entryinsert', $data);
            $this->load->view('footer');
        } else {
            $word = $this->input->post('word');
            $word_id = $this->member_model->search_word($word);
            if ($word_id == 0) {
                $word_id = $this->member_model->insert_word();
            }
            $is_freq = $this->member_model->search_word_id($word_id, $dict_id);

            $this->member_model->insert_entry($word_id, $dict_id, $is_freq);
            redirect('member/entry/' . $dict_id, 'location');
        }
    }

    public function entry_edit() {
        $this->load->model('dict_model');
        $dict_id = $this->uri->segment(3, 0);
        $data['dict'] = $this->member_model->show_dict($dict_id);
        $id = $this->uri->segment(4, 0);

        if ($id == '') {
            redirect('member', 'location');
        }

        $data['dict_id'] = $dict_id;
        $data['row'] = $this->member_model->show_word($id);
        $data['next'] = $this->dict_model->show_next_word($id,$dict_id);
        $data['pre'] = $this->dict_model->show_pre_word($id,$dict_id);

        $this->form_validation->set_rules('word', 'word', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header');
            $this->load->view('member/entry_edit', $data);
            $this->load->view('footer');
        } else {
            $word = $this->input->post('word');
            $word_id = $this->member_model->search_word($word);
            if ($word_id == 0) {
                $word_id = $this->member_model->insert_word();
            }
            $is_freq = $this->member_model->search_word_id($word_id, $dict_id);

            $this->member_model->update_entry($id, $word_id, $dict_id, $is_freq);
            redirect('member/entry_edit/' . $dict_id.'/'.$id, 'location');
        }
    }

    public function entryremove() {
        $dict_id = $this->uri->segment(3, 0);
        $id = $this->uri->segment(4, 0);
        if ($id == '') {
            redirect('member', 'location');
        }
        $this->db->query('delete from dict_words where id=' . $id);
        $this->db->query('delete from dict_bodies where id=' . $id);
        redirect('dict/show/'.$dict_id, 'location');
    }

    public function latex() {
        $this->load->helper('download');
        $this->load->helper('file');
        $this->load->helper('latex_helper');
        $id = intval($this->uri->segment(3, 0));
        if ($id == '') {
            redirect('member', 'location');
        }
        $row = $this->member_model->show_dict($id);
        $row2 = $this->member_model->show_dict_preamble($id);
        $identity = $row2['identity'];
        $identity = str_replace('<br />', '\\\\
', $identity);
        $identity2 = $row2['identity2'];
        $identity2 = str_replace('rule{8cm}{2pt}', '\rule{8cm}{2pt}', $identity2);
        $identity2 = str_replace('<br />', '\\\
', $identity2);
        $preamble = $row2['preamble'];
        $preamble = str_replace('<br /><br />', '

', $preamble);
        $preamble = str_replace('<br />', '
\\\\', $preamble);
        $data = read_file(base_url('data/latex/'.$row['direction'].'.txt'));
        $data .= '\title{\textbf{'.$row['title'].'}}
\author{'.$row['author'].' \thanks{'.$row2['thanks'].'}}
\date{}

\maketitle

\pagestyle{empty}

\begin{tcolorbox}[colframe=black,colback=white]
	\begin{tabular}{rrr}
		'.$identity.'
	\end{tabular}
\end{tcolorbox}

\vspace{20mm}

\begin{center}

'.$identity2.'

\end{center}

\newpage

\section*{مقدمه}
'.$preamble.'
\newpage
%\newpage~

\pagestyle{fancy}

';
        $alphabet = explode(' ', $row['alphabet']);
        foreach ($alphabet as $char) {
        $words = $this->member_model->show_words($id,$char);
            $data .= '\setLTR

';
        $data .= '\section*{'.ucfirst($char).'}

\begin{multicols}{2}

';
        foreach ($words as $value) {
            $pronun = $value['pronun'];
            $pronun = str_replace('[', '{\dolus [', $pronun);
            $pronun = str_replace(']', ']}', $pronun);
            $body = html_entity_decode($value['body']);
            $body = strip_tags(htmlspecialchars_decode($body));
            $body = str_replace('&#39;', '\'', $body);
            $body = str_replace('#', '\#', $body);
            $body = str_replace('[', '{\dolus [', $body);
            $body = str_replace(']', ']}', $body);
            $body = str_replace('&nbsp;', ' ', $body);
           $data .= '\entry{'.$value['word'].'}{'.$pronun.'}{'.$body.'}';
           $data .= '

';
        }
        $data .= '
\end{multicols}

\newpage

';
        }
        $string2 = read_file(base_url('data/latex/endtext.txt'));
        $data = $data.$string2;
        $name = 'dict'.$row['id'].'.tex';
        force_download($name, $data);
    }

    public function backup() {
        $this->load->dbutil();
        $prefs = array(
            'ignore' => array('users'), // List of tables to omit from the backup
            'format' => 'txt', // gzip, zip, txt
            'filename' => 'azarstarbackup.sql', // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => true, // Whether to add INSERT data to backup file
            'newline' => "\n"                         // Newline character used in backup file
        );
        $backup = $this->dbutil->backup($prefs);
        $this->load->helper('file');
        $this->load->helper('download');
        force_download('azarstarbackup.sql', $backup);
    }

    public function restore() {
        $dir = './data/';
        $config['upload_path'] = $dir;
        $config['file_name'] = 'backup';
        $config['allowed_types'] = 'sql';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('uploadfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('header');
            $this->load->view('member/restore', $error);
            $this->load->view('footer');
        } else {
            $data = array('upload_data' => $this->upload->data());

            if (file_exists('./data/backup.sql')) {
                $sql = file_get_contents("./data/backup.sql");
                $sqls = explode(';', $sql);
                array_pop($sqls);

                foreach ($sqls as $statement) {
                    $statment = $statement . ";";
                    $this->db->query($statement);
                }
            }
            redirect('', 'location');
        }
    }

    public function profile() {
        $this->load->library('form_validation');
        $data['row'] = $this->member_model->show_profile($this->session->userdata('user_id'));
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('header');
            $this->load->view('member/profile', $data);
            $this->load->view('footer');
        } else {
            $this->member_model->update_profile();
            redirect('', 'location');
        }
    }

}
