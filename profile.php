<?php
Class UserProfile {
    $sns = '';
    $users = array(
        'user_id' => '',
        'user_name' => '',
        'user_icon' => '',
        'user_page' => ''
    );

    public add_sns($user_sns) {
        $sns = $user_sns;
    }

    public add_user_id($user_id) {
        $users['user_id'] = $user_id;
    }

    public add_user_name($user_name) {
        $users['user_name'] = $user_name;
    }

    public add_user_icon($user_icon) {
        $users['user_icon'] = $user_icon;
    }

    public add_user_name($user_page) {
        $users['user_page'] = $user_page;
    }

    public get_users() {
        return $users;
    }
}
