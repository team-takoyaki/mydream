<?php
require_once('const.php');
require_once('profile.php');
require('twitteroauth/twitteroauth.php');
// Consumer keyの値
$consumer_key = 'CmlUO0TmsB5KXlVAE1LQ';
// Consumer secretの値
$consumer_secret = '1SR7AxpR05s875UCK632gr8r35e8uw0cNGh4xIF8SA';

//app
$app_addr = BASE_URL . '/top.php';

session_start();

// Twitterクライアントをリクエスト・トークンで起動
$client = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['request_token'], $_SESSION['request_token_secret']);

// アクセス・トークンを取得
$token = $client->getAccessToken($_GET['oauth_verifier']);
if (empty($token['oauth_token'])) {
    /*
     * アクセス・トークンがなければ、何らかの理由で取得失敗した。
     * もう一度リクエスト・トークンを生成して認証を試みる。
     */
     header('Location:' . BASE_URL . '/');
}

//userのaccess_token等を保存しておく
$_SESSION['access_token'] = $token['oauth_token'];
$_SESSION['access_token_secret'] = $token['oauth_token_secret'];

//user_name
$up = new UserProfile();
$up->set_user_id($token['user_id']);
$up->set_user_name($token['screen_name']);
$up->set_user_icon('http://api.twitter.com/1/users/profile_image?screen_name=' . $token['screen_name'] . '&size=normal');
$up->set_user_page('https://twitter.com/' . $token['screen_name']);
$_SESSION['up'] = serialize($up);
header('Location:' . BASE_URL . '/top.php');
