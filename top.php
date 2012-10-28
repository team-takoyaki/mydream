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

if (isset($_GET['page']) === true && $_GET['page'] !== '') {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}

if ($page < 1) {
    $page = 1;
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

$user_dreams = select_dreams_from_user_id($dbh, $user_id, $page);
if ($user_dreams === null) {
    echo '夢を取得できませんでした';
    exit;
}

/* ページングの処理 */
$all_page = (int)ceil($user_dreams['count'] / DREAM_DISPLAY_MAX);
if ($page > 1) {
    $prev_flag = true;
} else {
    $prev_flag = false;
}

if ($page < $all_page) {
    $next_flag = true;
} else {
    $next_flag = false;
}

$dbh = null;

include_once('tmpl/top.html.php');
