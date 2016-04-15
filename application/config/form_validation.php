<?php
$config = array(
    'user/create' => array(
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
    'user/edit' => array(
        array(
            'field' => 'name',
            'label' => '名前',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'メールアドレス',
            'rules' => 'required|trim|valid_email'
        ),
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