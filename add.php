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

if (isset($_POST['category_id']) === true && $_POST['category_id'] !== '') {
    $category_id = trim($_POST['category_id']);
}

$dbh = connect_db();
show_error_db($dbh);

if (isset($title) === true && isset($body) === true && isset($category_id) === true) { 
    if (insert_dream($dbh, $title, $body, $category_id, $user_id) === null) {
        echo 'insert dream on write_dream';
        exit();
    }
}

$user_info = select_user_from_user_id($dbh, $user_id);
if ($user_info === null) {
  echo 'error get user info on top';
  exit();
}
$user_page_url = get_user_page_url($user_info);

$dbh = null;

include_once(TMPL_DIR . '/add.html.php');

