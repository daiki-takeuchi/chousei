<?php

/**
 * Class Users
 *
 * @property Users_model $users_model
 */
class Users extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function index()
    {
        // 管理者じゃない場合はログインページに移動
        if (!$this->admin) {
            redirect(site_url());
        }

        $offset = $this->uri->segment(3 ,0);
        // 登録されているデータを全件取得
        $data['users'] = $this->users_model->get_users($offset);

        // paginationの作成
        $data['pagination'] = $this->users_model->get_pagination();

        $data['title'] = 'ユーザー一覧';

        // 各種viewを呼び出す
        $this->smarty->assign($data);
        $this->display('users/index.tpl');
    }

    public function pages()
    {
        $this->index();
    }

    public function create()
    {
        $this->edit();
    }

    public function edit($id = NULL)
    {
        // ログインしていなくて特定のユーザーの編集をしようとしている場合はログインページに移動
        if(!$this->is_login && !empty($id)) {
            redirect(site_url());
        }
        // 管理者じゃなくて自分以外のidの場合はホームに移動
        if (!$this->admin && $this->user_id != $id && !empty($id)) {
            redirect(site_url().'home');
        }

        $user = $this->_get_user($id);
        $data['title'] = $this->_get_title($user);

        if (empty($user) && !empty($id)) {
            $this->display('users/not_found.tpl');
            return;
        }

        if ($_POST) {
            $this->_save_user($user);
        }
        $data['user_item'] = $user;

        $this->smarty->assign($data);
        $this->display('users/user_form.tpl');
    }

    public function delete($id = NULL)
    {
        $user = $this->_get_user($id);
        if(isset($user['id'])) {
            $this->users_model->delete($user);
        }
        redirect('/users', 'refresh');
    }
    
    public function get_users_ajax()
    {
        //'*-- Ajax通信の場合のみ処理する
        if($this->input->is_ajax_request() && $this->admin) {
            $users = $this->users_model->find();
            echo json_encode($users);
        }
    }

    private function _get_user($id = NULL)
    {
        if ($id === NULL) {
            $user = array();
        } else {
            $user = $this->users_model->find($id);
        }
        return $user;
    }

    private function _get_title($user)
    {
        if (!isset($user['id'])) {
            return 'ユーザー登録';
        } else {
            return 'ユーザー編集';
        }
    }

    private function _save_user(&$user)
    {
        $mode = $this->uri->segment(2 ,0);
        if(isset($user['id']) && $user['id'] == $this->user_id) {
            $mode = "create";
        }

        $user['email'] = $this->input->post('email');
        $user['name'] = $this->input->post('name');
        if($this->admin && isset($user['id']) && $user['id'] == $this->user_id) {
            $user['admin'] = true;
        } else {
            $user['admin'] = $this->input->post('admin') === 'on';
        }
        $password = $this->input->post('password');
        if(!empty($password)) {
            $user['password'] = sha1($this->input->post('email').$this->input->post('password'));
        }

        if ($this->form_validation->run('user/'.$mode) !== FALSE) {
            $this->users_model->save($user);
            $user = $this->users_model->find($user['id']);
            if(!$this->is_login || $user['id'] == $this->user_id) {
                $data = array("user" => $user, "is_logged_in" => 1);
                $this->session->set_userdata($data);
                redirect('/', 'refresh');
            }
            redirect('/users', 'refresh');
        }
    }
}