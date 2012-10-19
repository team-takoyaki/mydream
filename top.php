<?php
require_once('const.php');
require_once('profile.php');
require_once('lib/model.php');
require_once('lib/helper.php');
session_start();
if (isset( $_SESSION['user_id']) === true) {
    $category = 'social';
    $is_choice = false;
    if (isset($_GET['category']) === true && $_GET['category'] !== '') {
        $category = $_GET['category'];
        $is_choice = true;
    }
    $dbh = connect_db();
    if ($dbh === null) {
        echo 'error';
        exit();
    }
    $users = select_user_from_user_id($dbh, $_SESSION['user_id']);
    if ($users['sns_id'] === 1) {
        $user_page = 'http://www.facebook.com/' . $users['sns_user_id'];
    } else if ($users['sns_id'] === 2) {
        //twitter
//        $user_page = 'http://twitter.com/' . $users[''];
    }
    var_dump($users);
    //$users = unserialize($_SESSION['up']);
    $dreams = select_dream_from_category($dbh, $category);

    $user_list = select_users($dbh);

    $dbh = null;
    if ($dreams === null) {
        echo 'error';
    }

    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
