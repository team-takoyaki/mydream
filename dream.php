<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

$is_my_dream = false;

if (isset($_SESSION['user_id']) === true && $_SESSION['user_id'] !== '') {
    $user_id = intval($_SESSION['user_id']);
}

if (isset($_GET['id']) === true && $_GET['id'] !== '') {
    $dream_id = intval($_GET['id']);
}


if (isset($_POST['user_comment']) === true && $_POST['user_comment'] !== '') {
    $user_comment = $_POST['user_comment'];
}

if (isset($_POST['comment_id']) === true && $_POST['comment_id'] !== '') {
    $comment_id = $_POST['comment_id'];
}

$dbh = connect_db();

if (isset($user_comment) === true && isset($user_id) === true) {
    insert_comment($dbh, $user_comment, $user_id, $dream_id);
}

if (isset($comment_id) === true && isset($user_id) === true && check_cheer_user_from_comment_id_and_user_id($dbh, $comment_id, $user_id) === true) {
    insert_cheer($dbh, $comment_id, $user_id);
}

if (isset($dream_id) === true && check_dream_id($dream_id) !== null) {
    $dream = select_dream_from_dream_id($dbh, $dream_id);
    $dream_user = $dream['user_id'];
    $comments = select_comments_from_dream_id($dbh, $dream_id);
    $cheer_users = array();
    foreach ($comments as $comment) {
        $cheer_users[$comment['id']] = select_cheer_count_from_comment_id($dbh, $comment['id']);
    }
}

if ($dream_user === $user_id) {
    $is_my_dream = true;
}

if (isset($dream) === true) {
  include_once(TMPL_DIR . '/dream.html.php');
} else {
  echo 'Error... Not found DREAM ID.';
}
