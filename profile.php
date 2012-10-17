<?php
Class UserProfile {
    var $sns = '';
    var $users = array(
        'user_sns' => '',
        'user_id' => '',
        'user_name' => '',
        'user_icon' => '',
        'user_page' => ''
    );

    function set_sns($sns) {
        $this->users['user_sns'] = $sns;
    }

    function set_user_id($user_id) {
        $this->users['user_id'] = $user_id;
    }

    function set_user_name($user_name) {
        $this->users['user_name'] = $user_name;
    }

    function set_user_icon($user_icon) {
        $this->users['user_icon'] = $user_icon;
    }

    function set_user_page($user_page) {
        $this->users['user_page'] = $user_page;
    }

    function get_users() {
        return $this->users;
    }

    function get_sns() {
        return $this->sns;
    }
}
