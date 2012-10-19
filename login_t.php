<?php
require_once('const.php');
require('twitteroauth/twitteroauth.php');
// Consumer keyの値
$consumer_key = 'CmlUO0TmsB5KXlVAE1LQ';
// Consumer secretの値
$consumer_secret = '1SR7AxpR05s875UCK632gr8r35e8uw0cNGh4xIF8SA';

//app
$app_addr = BASE_URL . '/success_t.php';

session_start();
if (isset($_SESSION['user_name']) === true) {
    //ログイン済みならトップページにリダイレクト
    header('Location:' . BASE . '/top.php');
}

if (isset($_SESSION['access_token']) === true) {
    //この方法でaccess_token, access_token_secretからuser情報をとれる
    $client = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['access_token'], $_SESSION['access_token_secret']);
    $result = $client->get('account/verify_credentials');
    if (isset($result->error) === true) {
        //OAuthがerrorの時
//        echo 'error';
    } else {
        var_dump($result);
        //header();
    }
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
