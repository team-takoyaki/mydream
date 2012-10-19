<?php
require_once('const.php');
require_once('profile.php');
require_once('lib/model.php');
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


if (isset($_SESSION['access_token']) === true) {
    $_SESSION['access_token'] = $facebook->getAccessToken();
    $me = $facebook->api('/me?access_token=' . $_SESSION['access_token']);
    //ここでDB dr_userからidを取得し, $_SESSIONに保存
    $_SESSION['user_id'] = $me['id'];
    header('Location:' . BASE_URL . '/top.php');
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
        $user_profile = $facebook->api('/me');

        $user_name = $user_profile['name'];
        $sns_user_id = $user_profile['id'];
        $profile_image = 'https://graph.facebook.com/' . $user_profile['id'] . '/picture';
        $dbh = connect_db();
        $sns_id = select_sns_id_from_sns_name($dbh, 'facebook');
//        $sns_id = 1;
        $user_id = insert_user($dbh, $user_name, $profile_image, $sns_id, $sns_user_id);
        var_dump($user_id);
        $_SESSION['user_id'] = $user_id;

        $up = new UserProfile();
        $up->set_dr_user_id($user_id);
        $up->set_user_id($user_profile['id']);
        $up->set_user_name($user_name);
        $up->set_user_icon($profile_image);
        $up->set_user_page('https://facebook.com/' . $user_profile['id']);
        $_SESSION['up'] = serialize($up);
        $_SESSION['user_id'] = $user_id;
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


function select_sns_id_from_sns_name($dbh, $sns_name) {
    $sql = 'select id from dr_sns where sns_name = :sns_name';
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':sns_name' => $sns_name
            )
        );
        $result = $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
    return $result;
}
