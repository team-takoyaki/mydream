<?php
require('facebook/facebook.php');

$facebook = new Facebook(
    array(
        'appId'  => '374347855978872',
        'secret' => '536567b550148b60c596c333e3ee7dd2',
        'cookie' => true
    )
);


$user = $facebook->getUser();

var_dump($user);

if ($user) {
    try {
        $me = $facebook->api('/me');
    } catch (FacebookApiException $e) {
        $user = null;
    }
}

if (!$user) {
    $login_url = $facebook->getLoginUrl();
}


var_dump($me);
