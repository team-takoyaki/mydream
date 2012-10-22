<?php
require_once('const.php');
require_once('profile.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();


if (isset( $_SESSION['user_id']) === true) {
    $category = 'social';
    $is_choice = false;
    if (isset($_GET['category']) === true && $_GET['category'] !== '') {
        $category = $_GET['category'];
        $is_choice = true;
    }
    $dbh = connect_db();
    show_error_db($dbh);

    if ($is_choice === true) {
        //夢情報の取得
        $category_id = select_category_id_from_dr_dream($dbh, $category);
        $dreams = select_dream_from_category($dbh, $category_id);
        if ($dreams === null) {
            echo 'error get dreams...';
        }
    }

    //user情報を取得する
    $users = select_user_from_user_id($dbh, $_SESSION['user_id']);
    if ($users['sns_id'] === 1) {
        //facebook
        $user_page = 'http://www.facebook.com/' . $users['sns_user_id'];
    } else if ($users['sns_id'] === 2) {
        //twitter
        $user_page = 'http://twitter.com/' . $users['user_name'];
    }

    $user_list = select_users($dbh);

    $dbh = null;

    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
