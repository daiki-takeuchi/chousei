<?php

/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2015/10/16
 * Time: 2:46
 */
class MY_Form_validation extends CI_Form_validation
{
    function validate_credentials()
    {
        $email = $this->CI->input->post("email");
        $password = $this->CI->input->post("password");
        $this->CI->load->model("users_model");

        if($this->CI->users_model->can_log_in($email, $password)) {
            return true;
        } else {
            $this->set_message("validate_credentials", "メールアドレスかパスワードが異なります。");
            return false;
        }
    }

    function validate_duplicate_user()
    {
        $email = $this->CI->input->post("email");
        $user_id = $this->CI->input->post("user_id");
        $this->CI->load->model("users_model");

        $user = $this->CI->users_model->find_by_email($email);

        if(isset($user) && $user["id"] !== $user_id) {
            $this->set_message("validate_duplicate_user", "すでに同じメールアドレスが登録されています。");
            return false;
        }
        return true;
    }
}