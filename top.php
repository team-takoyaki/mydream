<?php
require_once('const.php');
require_once('profile.php');
require_once('lib/model.php');
session_start();
if (isset($_SESSION['up'])) {
    if (isset($_GET['category']) === true && $_GET['category'] !== '') {
        $category = $_GET['category'];
    } else {
        $category = 'social';
    }
    $dbh = connect_db();
    $dreams = select_dream_from_category($dbh, $category);
    $dbh = null;
    if ($dreams !== null) {
        if (is_array($dreams) === true) {
            var_dump($dreams);
        } else {
            echo 'nothing dream...';
        }
    } else {
        echo 'error';
    }
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
