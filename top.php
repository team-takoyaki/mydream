<?php
require_once('const.php');
require_once('profile.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

if (isset($_SESSION['user_id']) === true && $_SESSION['user_id'] !== '') {
    $user_id = $_SESSION['user_id'];
} else {
    header('Location:' . BASE_URL);
    exit;
}

//user情報を取得する
$dbh = connect_db();
show_error_db($dbh);

$user_info = select_user_from_user_id($dbh, $user_id);
if ($user_info === null) {
    echo 'ユーザー情報が取得できませんでした';
    exit;
}
$user_name = $user_info['user_name'];

/* $user_page_url = get_user_page_url($user_info); */

/* $user_list = select_users($dbh); */
/* if ($user_list === null) { */
/*     echo 'error user_list on top'; */
/*     exit(); */
/* } */

$user_dreams = select_dreams_from_user_id($dbh, $user_id);
if ($user_dreams === null) {
    echo '夢を取得できませんでした';
    exit;
}

$dbh = null;

include_once('tmpl/top.html.php');
