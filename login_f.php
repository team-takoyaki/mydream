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
        $_SESSION['user_name'] = $user_profile['name'];
        $_SESSION['user_icon'] = 'https://graph.facebook.com/' . $user_profile['id'] . '/picture';
        $_SESSION['user_page'] = 'https://facebook.com/' . $user_profile['id'];
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
