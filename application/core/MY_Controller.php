<?php

/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/09/26
 * Time: 14:20
 */
class MY_Controller extends CI_Controller
{

    protected $is_login;
    protected $user_id;
    protected $user_name;
    protected $admin;

    public function __construct()
    {
        parent::__construct();
        $this->smarty->template_dir = APPPATH . 'views';
        $this->smarty->compile_dir = APPPATH . 'views/templates_c';

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $userdata = $this->session->userdata();
        $data['is_login'] = $this->is_login = isset($userdata["is_logged_in"]) ? $userdata["is_logged_in"] : false;
        $data['user_id'] = $this->user_id = isset($userdata["user"]) ? $userdata["user"]["id"] : false;
        $data['user_name'] = $this->user_name = isset($userdata["user"]) ? $userdata["user"]["name"] : false;
        $data['email'] = $this->user_name = isset($userdata["user"]) ? $userdata["user"]["email"] : false;
        $data['admin'] = $this->admin = isset($userdata["user"]) ? $userdata["user"]["admin"] === 't' : false;

        $this->smarty->assign($data);
    }

    /**
     * @param String $template
     * @return void
     */
    public function display($template)
    {
        $this->smarty->display($template);
    }
}