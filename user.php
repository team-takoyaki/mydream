<?php
require_once('const.php');
require_once('profile.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

if (isset($_GET['user_id']) === true && $_GET['user_id'] !== '') {
    $user_id = intval($_GET['user_id']);
} else if (isset($_SESSION['user_id']) === true) {
    $user_id = $_SESSION['user_id'];
} else {
    header('Location:' . BASE_URL);
    exit;
}

$dbh = connect_db();
show_error_db($dbh);
if (isset($user_id) === true) {
    $user = select_user_from_user_id($dbh, $user_id);
    $dreams = select_dreams_from_user_id($dbh, $user_id);
    if ($user === null || $dreams === null) {
        echo 'error user or dreams on user';
        exit();
    }
    $user_name = $user['user_name'];
    $user_image = $user['user_image'];
}

$dbh = null;

include_once(TMPL_DIR . '/user.html.php');
