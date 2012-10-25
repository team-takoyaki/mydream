<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
require('twitteroauth/twitteroauth.php');
session_start();
$consumer_key = 'CmlUO0TmsB5KXlVAE1LQ';
// Consumer secretの値
$consumer_secret = '1SR7AxpR05s875UCK632gr8r35e8uw0cNGh4xIF8SA';

if (isset($_SESSION['t']['access_token']) === true && isset($_SESSION['t']['access_token_secret']) === true) {
    $access_token = $_SESSION['t']['access_token'];
    $access_secret = $_SESSION['t']['access_token_secret'];
} else {
    echo 'error on session twitter';
    exit();
}

$to = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_secret);

$content = $to->OAuthRequest(
    'https://api.twitter.com/1/statuses/update.xml',
    'POST',
    array(
        'status' => 'Test tweet.' . TWITTER_HASH
    )
);
//var_dump($content);
//とりあえずindexにリダイレクト
header('Location:' . BASE_URL);
