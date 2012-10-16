<?php
require('facebook/facebook.php');

$facebook = new Facebook(
    array(
        'appId'  => '124401297710327',
        'secret' => '9e5d861e6031580f4af546158f352b84',
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
?>
<img src="https://graph.facebook.com/<?= $me['username'];?>/picture">
