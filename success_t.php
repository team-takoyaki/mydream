<?php
require_once('const.php');
require_once('profile.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
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

//userのaccess_tokenを保存しておく
$_SESSION['t']['access_token'] = $token['oauth_token'];
$_SESSION['t']['access_token_secret'] = $token['oauth_token_secret'];

//DB保存用
$sns_user_id = $token['user_id'];
$user_name = $token['screen_name'];
$profile_image = 'http://api.twitter.com/1/users/profile_image?screen_name=' . $token['screen_name'] . '&size=normal';

$dbh = connect_db();
show_error_db($dbh);
$sns_id = select_sns_id_from_sns_name($dbh, DR_SNS_TWITTER);
if ($sns_id === null) {
    echo 'error sns_id on twitter';
    exit();
}
$_SESSION['user_id'] = insert_user($dbh, $user_name, $profile_image, $sns_id, $sns_user_id);
if ($_SESSION['user_id'] === null) {
    echo 'error insert on success_t';
    exit();
}
$dbh = null;

header('Location:' . BASE_URL . '/top.php');
