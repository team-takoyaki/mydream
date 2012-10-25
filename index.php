<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();
$is_login = false;
$post_url = null;
$session_user_id = $_SESSION['user_id'];

//var_dump($_SESSION['t']);
//var_dump($_SESSION['f']);

$dbh = connect_db();
show_error_db($dbh);

if (isset($session_user_id) === true ) {
    $is_login = true;
    $user_info = select_user_from_user_id($dbh, $session_user_id);
//    var_dump($user_info);
    if ($user_info === null) {
        echo 'error on get user info';
        exit();
    }
    if ($user_info['sns_id'] === 1) {
        $post_url = 'post_f.php';
    } else if ($user_info['sns_id'] === 2) {
        $post_url = 'post_t.php';
    }
}

$dreams = select_id_and_title_from_dr_dream($dbh);
$dbh = null;
if ($dreams === null) {
    echo 'error get dreams';
    exit();
}
include_once(TMPL_DIR . '/index.html.php');
/*
if (isset($_SESSION['user_id']) === true) {
    header('Location:' . BASE_URL . '/top.php');
} else {
    include_once('tmpl/index.html.php');
}
*/
