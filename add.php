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

if (isset($_POST['add_submit']) === true && $_POST['add_submit'] !== '') {
    $add_submit = $_POST['add_submit'];
}

if (isset($_POST['title']) === true && $_POST['title'] !== '') {
    $title = trim($_POST['title']);
}

if (isset($_POST['category_id']) === true && $_POST['category_id'] !== '') {
    $category_id = trim($_POST['category_id']);
    $category_selected = array($category_id => 'selected');
}

$dbh = connect_db();
show_error_db($dbh);

if (isset($add_submit) === true) {
    if (isset($title) === true && isset($category_id) === true) {
        $dream_id = insert_dream($dbh, $title, '', $category_id, $user_id);
        if ($dream_id !== null && check_dream_id($dream_id) !== false) {
            $redirect_url = BASE_URL . '/dream.php?id=' . $dream_id;
            header('Location:' . $redirect_url);
            exit;
        } else {
            echo '夢を書き込めませんでした';
            exit;
        }
    } else {
        $error_message = true;
    }
}

$user_info = select_user_from_user_id($dbh, $user_id);
if ($user_info === null) {
    echo 'ユーザー情報が取得できませんでした';
    exit;
}
$user_name = $user_info['user_name'];
/* $user_page_url = get_user_page_url($user_info); */

$dbh = null;

include_once(TMPL_DIR . '/add.html.php');

