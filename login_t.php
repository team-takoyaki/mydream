<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require('twitteroauth/twitteroauth.php');
// Consumer keyの値
$consumer_key = 'CmlUO0TmsB5KXlVAE1LQ';
// Consumer secretの値
$consumer_secret = '1SR7AxpR05s875UCK632gr8r35e8uw0cNGh4xIF8SA';

//app
$app_addr = BASE_URL . '/success_t.php';

session_start();
if (isset($_SESSION['user_id']) === true) {
    //ログイン済みならトップページにリダイレクト
    header('Location:' . BASE_URL . '/top.php');
    exit();
}

if (isset($_SESSION['t']['access_token']) === true && isset($_SESSION['t']['access_token_secret']) === true) {
    //この方法でaccess_token, access_token_secretからuser情報をとれる
    $client = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['t']['access_token'], $_SESSION['t']['access_token_secret']);
    $result = $client->get('account/verify_credentials');
    if (isset($result->error) === true) {
        //OAuthがerrorの時
        //echo 'error';
    } else {
        $dbh = connect_db();
        $_SESSION['user_id'] = select_id_from_dr_user($dbh, DR_SNS_TWITTER, $result->id_str);
        header('Location:' . BASE_URL . '/top.php');
        exit();
    }
}

// 初めてアプリを認証するとき
$client = new TwitterOAuth($consumer_key, $consumer_secret);

// リクエスト・トークンを取得してセッション変数に保存
$token = $client->getRequestToken($app_addr);
$_SESSION['request_token'] = $token['oauth_token'];
$_SESSION['request_token_secret'] = $token['oauth_token_secret'];

// 認証ページのアドレス
$auth_addr = $client->authorizeURL() . '?oauth_token=' . $token['oauth_token'];

// ここで$auth_addrにユーザを誘導する
header('Location:' . $auth_addr);
