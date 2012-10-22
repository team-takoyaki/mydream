<?php
require_once('const.php');
require_once('profile.php');
require_once(BASE . '/lib/model.php');
session_start();

if (isset($_SESSION['user_id']) === true) {
    //$oauth_user = unserialize($_SESSION['up']);
    //$user_id = $oauth_user->users['dr_user_id'];
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

if (isset($title) === true && isset($body) === true && isset($category) === true) { 
    $category_id = select_category_id_from_dr_dream($dbh, $category);
    insert_dream($dbh, $title, $body, $category_id, $user_id);
}

$dreams = select_dreams($dbh);

$dbh = null;

include_once(TMPL_DIR . '/write_dream.html.php');

