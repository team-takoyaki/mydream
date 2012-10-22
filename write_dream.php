<?php
require_once('const.php');
require_once('profile.php');
require_once(BASE . '/lib/helper.php');
require_once(BASE . '/lib/model.php');
session_start();

if (isset($_SESSION['user_id']) === true) {
    $user_id = $_SESSION['user_id'];
} else {
    header('Location:' . BASE_URL);
    exit;
}

if (isset($_POST['title']) === true && $_POST['title'] !== '') {
    $title = trim($_POST['title']);
}

if (isset($_POST['body']) === true && $_POST['body'] !== '') {
    $body = trim($_POST['body']);
}

if (isset($_POST['category']) === true && $_POST['category'] !== '') {
    $category = trim($_POST['category']);
}

$dbh = connect_db();

show_error_db($dbh);

if (isset($title) === true && isset($body) === true && isset($category) === true) { 
    $category_id = select_category_id_from_dr_dream($dbh, $category);
    if ($category_id === null) {
        echo 'error category id on write_dream';
        exit();
    }
    $flg = insert_dream($dbh, $title, $body, $category_id, $user_id);
    if ($flg === null) {
        echo 'insert dream on write_dream';
        exit();
    }
}

$dreams = select_dreams($dbh);
if ($dreams === null) {
    echo 'error dreams on write_dream';
    exit();
}

$dbh = null;

include_once(TMPL_DIR . '/write_dream.html.php');

