<?php
require('twitteroauth/twitteroauth.php');
// Consumer keyの値
$consumer_key = 'CmlUO0TmsB5KXlVAE1LQ';
// Consumer secretの値
$consumer_secret = '1SR7AxpR05s875UCK632gr8r35e8uw0cNGh4xIF8SA';
// Access Tokenの値
//$access_token = "171915310-8tPvs9cT1LvaG91PbLVHHZAoY4ADnQgje6l7fwU1";
// Access Token Secretの値
//$access_token_secret = "4ssMP0qZ7RuesDJfiP2LDBHJD86BPXDwjDrIxtw1IY";

//app
$app_addr = 'http://team-takoyaki.com/dream/success_t.php';

session_start();
if (isset($_SESSION['user_name'])) {
    //ログイン済みならトップページにリダイレクト
    header('Location:http://team-takoyaki.com/dream/top.php');
}

// Twitterクライアント起動
$client = new TwitterOAuth($consumer_key, $consumer_secret);

// リクエスト・トークンを取得してセッション変数に保存
$token = $client->getRequestToken($app_addr);
$_SESSION['request_token'] = $token['oauth_token'];
$_SESSION['request_token_secret'] = $token['oauth_token_secret'];

// 認証ページのアドレス
$auth_addr = $client->authorizeURL() . '?oauth_token=' . $token['oauth_token'];

// ここで$auth_addrにユーザを誘導する
header('Location:' . $auth_addr);
