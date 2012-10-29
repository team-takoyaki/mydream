<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

if (isset($_SESSION['user_id']) === true && $_SESSION['user_id'] !== '') {
    $user_id = $_SESSION['user_id'];
} else {
    header('Location:' . BASE_URL);
    exit;
}

if (isset($_GET['id']) === true && $_GET['id'] !== '') {
    $comment_id = intval($_GET['id']);
}

if (isset($_POST['comment']) === true && $_POST['comment'] !== '') {
    $comment = $_POST['comment'];
}

if (isset($_POST['public_submit']) === true && $_POST['public_submit'] !== '') {
    $public_submit = $_POST['public_submit'];
}

if (isset($_POST['unpublic_submit']) === true && $_POST['unpublic_submit'] !== '') {
    $unpublic_submit = $_POST['unpublic_submit'];
}

if (isset($_POST['update_submit']) === true && $_POST['update_submit'] !== '') {
    $update_submit = $_POST['update_submit'];
}

if (check_dream_id($comment_id) === false) {
    echo '不正なアクセスです';
    exit;
}

$dbh = connect_db();
show_error_db($dbh);

$update_flg = false;

if (isset($unpublic_submit) === true) {
    update_comment_order_num($dbh, $comment_id, 0);
    $update_flg = true;
}

if (isset($public_submit) === true) {
    update_comment_order_num($dbh, $comment_id, 1);
    $update_flg = true;
}

if (isset($update_submit) === true && isset($comment) === true) {
    if (update_comment($dbh, $comment_id, $comment) === null) {
        echo 'コメントを書き込めませんでした';
        exit;
    }
    $update_flg = true;
}

if (isset($user_id) === true) {
    $user_info = select_user_from_user_id($dbh, $user_id);
    if ($user_info === null) {
        echo 'ユーザー情報が取得できませんでした';
        exit;
    }
    $user_name = $user_info['user_name'];
}

$comment = select_comment_from_comment_id($dbh, $comment_id);

if ($update_flg) {
    header('Location:' . BASE_URL . '/dream.php?id=' . $comment['dream_id'] . '&comment_id=' . $comment['id']);
    exit;
}

$dbh = null;

include_once(TMPL_DIR . '/comment.html.php');
