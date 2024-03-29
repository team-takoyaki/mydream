<?php
require_once('const.php');
require_once('profile.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
require_once('facebook/facebook.php');
session_start();


$facebook = new Facebook(
    array(
        'appId'  => '124401297710327',
        'secret' => '9e5d861e6031580f4af546158f352b84',
    )
);


if (isset($_SESSION['user_id']) === true) {
    //sessionにuser_idが残っているとき
    header('Location:' . BASE_URL . '/top.php');
    exit();
}

if (isset($_SESSION['f']['access_token']) === true) {
    $me = $facebook->api('/me?access_token=' . $_SESSION['f']['access_token']);
    //ここでDB dr_userからidを取得し, $_SESSIONに保存
    $dbh = connect_db();
    show_error_db($dbh);
    $user_id = select_id_from_dr_user($dbh, DR_SNS_FACEBOOK, $me['id']);
    if ($user_id === null) {
        echo 'error user_id on facebook';
        exit();
    }
    $_SESSION['user_id'] = $user_id;
    $dbh = null;
    header('Location:' . BASE_URL . '/top.php');
    exit();
}


// Get User ID
$user = $facebook->getUser();
//投稿とfriendリストももらっておく
$par = array('scope' => FB_PERMISSION);
$fb_login_url = $facebook->getLoginUrl($par);
$redirect_uri = BASE_URL . '/s_login_f.php';


if ($user !== 0) {
    //$userにユーザー情報が入っていないときは$user = 0になってる
    try {
    //Proceed knowing you have a logged in user who's authenticated.
        $_SESSION['f']['access_token'] = $facebook->getAccessToken();
        $user_profile = $facebook->api('/me');

        $user_name = $user_profile['name'];
        $sns_user_id = $user_profile['id'];
        $profile_image = 'https://graph.facebook.com/' . $user_profile['id'] . '/picture';
        $dbh = connect_db();
        show_error_db($dbh);
        $sns_id = select_sns_id_from_sns_name($dbh, DR_SNS_FACEBOOK);
        if ($sns_id === null) {
            echo 'error sns_id on facebook';
            exit();
        }
        $_SESSION['user_id'] = insert_user($dbh, $user_name, $profile_image, $sns_id, $sns_user_id);
        if ($_SESSION['user_id'] === null) {
            echo 'error insert on facebook';
            exit();
        }

        $dbh = null;

        header('Location:' . BASE_URL . '/top.php');
        exit();
    } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
    }
} else {
    $loginUrl = $facebook->getLoginUrl(
        array(
            'scope' => FB_PERMISSION
        )
    );
    //ログインしてもらう
    header('Location:' . $loginUrl);
}
