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

if (isset($_POST['cheers']) === true && $_POST['cheers'] !== '') {
    $cheers = $_POST['cheers'];
}

$dbh = connect_db();

if (isset($user_comment) === true && isset($user_id) === true) {
    insert_comment($dbh, $user_comment, $user_id, $dream_id);
}

if (isset($comment_id) === true && isset($user_id) === true && check_thank_user_from_comment_id_and_user_id($dbh, $comment_id, $user_id) === 0) {
    insert_thank($dbh, $comment_id, $user_id);
}

if (isset($dream_id) === true && check_dream_id($dream_id) !== null) {
    if (isset($cheers) === true && isset($user_id) === true && check_cheer_user_from_dream_id_and_user_id($dbh, $dream_id, $user_id) === 0) {
        insert_cheer($dbh, $dream_id, $user_id);
    }
    $cheer_users = select_cheer_count_from_dream_id($dbh, $dream_id);
    $dream = select_dream_from_dream_id($dbh, $dream_id);
    $dream_user = $dream['user_id'];
    $comments = select_comments_from_dream_id($dbh, $dream_id);
    $thank_users = array();
    foreach ($comments as $comment) {
        $thank_users[$comment['id']] = select_thank_count_from_comment_id($dbh, $comment['id']);
        //comment, user_idから紐付いたthankカウント取得
        $thank_count = check_thank_user_from_comment_id_and_user_id($dbh, $comment['id'], $user_id);
        $is_thank[$comment['id']] = true;
        if ($comment['user_id'] === $user_id || $thank_count > 0) {
            //commentのuser_idがアクセス者のuser_idと同じ, thank_countが0より大きい場合はthankは押せない
            $is_thank[$comment['id']] = false;
        }
    }
}

if ($dream_user === $user_id) {
    $is_my_dream = true;
}

$dbh = null;

if (isset($dream) === true) {
  include_once(TMPL_DIR . '/dream.html.php');
} else {
  echo 'Error... Not found DREAM ID.';
}
