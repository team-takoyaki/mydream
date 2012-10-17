<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
require_once('const.php');
require_once('profile.php');
require_once('lib/model.php');
require 'facebook/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(
    array(
        'appId'  => '124401297710327',
        'secret' => '9e5d861e6031580f4af546158f352b84',
    )
);

// Get User ID
$user = $facebook->getUser();


if ($user) {
    try {
    //Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
        $user_name = $user_profile['name'];
        $profile_image = 'https://graph.facebook.com/' . $user_profile['id'] . '/picture';
        $dbh = connect_db();
        $user_id = insert_user($dbh, $user_name, $profile_image);

        $up = new UserProfile();
        $up->set_dr_user_id($user_id);
        $up->set_user_id($user_profile['id']);
        $up->set_user_name($user_name);
        $up->set_user_icon($profile_image);
        $up->set_user_page('https://facebook.com/' . $user_profile['id']);
        $_SESSION['up'] = serialize($up);
        header('Location:' . BASE_URL . '/top.php');
        exit();
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
}


// Login or logout url will be needed depending on current user state.
if ($user) {
    $logoutUrl = $facebook->getLogoutUrl();
} else {
    $loginUrl = $facebook->getLoginUrl();
    //ログインしてもらう
    header('Location:' . $loginUrl);
}
