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
    ),
    'events' => array(
        array(
            'field' => 'title',
            'label' => 'タイトル',
            'rules' => 'required|trim'
        ),
        array(
            'field' => 'date',
            'label' => '日付',
            'rules' => 'required|date_valid'
        ),
        array(
            'field' => 'start_time',
            'label' => '開始時間',
            'rules' => 'required|time_valid'
        ),
        array(
            'field' => 'end_time',
            'label' => '終了時間',
            'rules' => 'required|time_valid'
        ),
        array(
            'field' => 'number_of_people',
            'label' => '募集人数',
            'rules' => 'required|greater_than[0]'
        )
    )
);