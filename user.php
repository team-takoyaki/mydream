<?php
require_once('const.php');
require_once('profile.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

if (isset($_GET['user_id']) === true && $_GET['user_id'] !== '') {
    $user_id = intval($_GET['user_id']);
} else if (isset($_SESSION['up']) === true) {
    $oauth_user = unserialize($_SESSION['up']);
    $user_id = $oauth_user->users['dr_user_id'];
} else {
    header('Location:' . BASE_URL);
    exit;
}

$dbh = connect_db();
$user_id = 32;
if (isset($user_id) === true) {
    $user = select_user_from_user_id($dbh, $user_id);
    $user_name = $user['user_name'];
    $user_image = $user['user_image'];
    $dreams = select_dreams_from_user_id($dbh, $user_id);
}

include_once(TMPL_DIR . '/user.html.php');
