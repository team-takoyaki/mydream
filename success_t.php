<?php
require_once('const.php');
require('twitteroauth/twitteroauth.php');
// Consumer keyの値
$consumer_key = 'CmlUO0TmsB5KXlVAE1LQ';
// Consumer secretの値
$consumer_secret = '1SR7AxpR05s875UCK632gr8r35e8uw0cNGh4xIF8SA';

//app
$app_addr = BASE . '/top.php';

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
     header('Location:' . BASE . '/dream');
}

//userのaccess_token等を保存しておく
$_SESSION['access_token'] = $token['oauth_token'];
$_SESSION['access_token_secret'] = $token['oauth_token_secret'];

//user_name
$tw_user_name = $token['screen_name'];
$_SESSION['user_name'] = $tw_user_name;
header('Location:' . BASE . '/top.php');
