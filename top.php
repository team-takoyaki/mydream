<?php
require_once('const.php');
require_once('profile.php');
require_once('lib/model.php');
session_start();
if (isset($_SESSION['up'])) {
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
    $dreams = select_dream_from_category($dbh, $category);
    $dbh = null;
    if ($dreams === null) {
        echo 'error';
    }
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
