<?php

class Pages extends MY_Controller
{
    public function index()
    {
        $this->display('pages/login.tpl');
    }

    public function home()
    {
        // ログインしてない場合はログイン画面に移動
        if(!$this->session->userdata("is_logged_in")) {
            redirect(site_url());
        }
        $this->display('pages/home.tpl');
    }

    public function login()
    {
        // ログインしている場合はホームに移動
        if($this->session->userdata("is_logged_in")) {
            redirect(site_url().'home');
        }
var_dump($_POST);
        if (isset($_POST)) {
            $this->_login_validation();
        }
        $data['post'] = $_POST;

        $this->smarty->assign($data);
        $this->display('pages/login.tpl');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(site_url());
    }

    private function _login_validation()
    {
        $this->load->library("form_validation");

        if ($this->form_validation->run('login') !== FALSE) {
            $email = $this->input->post("email");
            $user = $this->users_model->find_by_email($email);
            $data = array(
                "user" => $user,
                "is_logged_in" => 1
            );
            $this->session->set_userdata($data);
            redirect(site_url().'home');
        }
    }
}