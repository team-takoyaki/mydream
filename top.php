<?php
require_once('const.php');
require_once('profile.php');
require_once('lib/model.php');
require_once('lib/helper.php');
session_start();
if (isset($_SESSION['up']) === true) {
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
    $users = unserialize($_SESSION['up']);
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
