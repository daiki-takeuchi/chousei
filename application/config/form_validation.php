<?php
$config = array(
    'user' => array(
        array(
            'field' => 'name',
            'label' => '名前',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'メールアドレス',
            'rules' => 'required|trim|valid_email|validate_duplicate_user'
        ),
        array(
            'field' => 'password',
            'label' => 'パスワード',
            'rules' => 'required|trim|matches[password_confirmation]'
        ),
        array(
            'field' => 'password_confirmation',
            'label' => 'パスワードの確認',
            'rules' => 'required|trim'
        )
    ),
    'login' => array(
        array(
            'field' => 'email',
            'label' => 'メールアドレス',
            'rules' => 'required|trim|valid_email|validate_credentials'
        ),
        array(
            'field' => 'password',
            'label' => 'パスワード',
            'rules' => 'required|sha1|trim'
        )
    )
);