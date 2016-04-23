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

    /**
     * Validate yyyy/mm/dd
     */
    function date_valid($date)
    {
        $parts = explode("/", $date);
        if (count($parts) == 3) {
            if (checkdate($parts[1], $parts[2], $parts[0]))
            {
                return true;
            }
        }
        $this->set_message('date_valid', '%s欄は yyyy/mm/dd形式である必要があります。');
        return false;
    }

    /**
     * Validate HH:MM
     */
    function time_valid($time)
    {
        $parts = explode(':', $time);
        if (count($parts) != 2) {
            $this->set_message('time_valid', '%s欄は HH:MM形式である必要があります。');
            return false;
        }
        list($hh, $mm) = $parts;
        if (!is_numeric($hh) || !is_numeric($mm))
        {
            $this->set_message('time_valid', '%s欄が数字ではありません。');
            return false;
        }
        else if ((int) $hh > 24 || (int) $mm > 59 || (int) $hh < 0 || (int) $mm < 0)
        {
            $this->set_message('time_valid', '%s欄の時刻が正しくありません。');
            return false;
        }
        else if (mktime((int) $hh, (int) $mm) === false)
        {
            $this->set_message('time_valid', '%s欄の時刻が正しくありません。');
            return false;
        }

        return true;
    }
}