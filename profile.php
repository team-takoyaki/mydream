<?php
Class UserProfile {
    var $sns = '';
    var $users = array(
        'user_id' => '',
        'user_name' => '',
        'user_icon' => '',
        'user_page' => ''
    );

    function add_sns($user_sns) {
        $this->$sns = $user_sns;
    }

    function add_user_id($user_id) {
        $this->$users['user_id'] = $user_id;
    }

    function add_user_name($user_name) {
        $this->$users['user_name'] = $user_name;
    }

    function add_user_icon($user_icon) {
        $this->$users['user_icon'] = $user_icon;
    }

    function add_user_name($user_page) {
        $this->$users['user_page'] = $user_page;
    }

    function  get_users() {
        return $users;
    }
}
