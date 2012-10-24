<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

$is_my_dream = false;

if (isset($_SESSION['user_id']) === true && $_SESSION['user_id'] !== '') {
    $user_id = intval($_SESSION['user_id']);
} else {
    header('Location:' . BASE_URL);
    exit;
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

show_error_db($dbh);

if (isset($user_comment) === true && isset($user_id) === true) {
    $flg = insert_comment($dbh, $user_comment, $user_id, $dream_id);
    if ($flg === null) {
        echo 'insert error';
        exit();
    }
}


$cnt = check_thank_user_from_comment_id_and_user_id($dbh, $comment_id, $user_id);
if ($cnt === null) {
    echo 'sql error';
    exit();
}

if (isset($comment_id) === true && isset($user_id) === true && $cnt === 0) {
    $flg = insert_thank($dbh, $comment_id, $user_id);
    if ($flg === null) {
        echo 'insert error';
        exit();
    }
}

if (isset($dream_id) === true && check_dream_id($dream_id) !== null) {
    $cnt = check_cheer_user_from_dream_id_and_user_id($dbh, $dream_id, $user_id);
    if ($cnt === null) {
        echo 'sql error';
        exit();
    }
    if (isset($cheers) === true && isset($user_id) === true && $cnt === 0) {
        $flg = insert_cheer($dbh, $dream_id, $user_id);
        if ($flg === null) {
            echo 'insert error';
            exit();
        }
    }

    $cheer_users = select_cheer_count_from_dream_id($dbh, $dream_id);
    if ($cheer_users === null) {
        echo 'error cheer_users';
        exit();
    }

    $dream = select_dream_from_dream_id($dbh, $dream_id);
    if ($dream === null) {
        echo 'error dream';
        exit();
    }
    $dream_user = $dream['user_id'];
    $comments = select_comments_from_dream_id($dbh, $dream_id);
    if ($comments === null) {
        echo 'error comments';
        exit();
    }
    $thank_users = array();
    foreach ($comments as $comment) {
        $thank_usr = select_thank_count_from_comment_id($dbh, $comment['id']);
        $thank_count = check_thank_user_from_comment_id_and_user_id($dbh, $comment['id'], $user_id);
        if ($thank_usr === null || $thank_count === null) {
            echo 'error thank user or thank count';
            exit();
        }
        $thank_users[$comment['id']] = $thank_usr;
        //comment, user_idから紐付いたthankカウント取得
        $is_thank[$comment['id']] = false;
        if ($user_id === intval($dream_user) && $thank_count === 0) {
            //夢のuser_idとアクセス者のuser_idが等しくかつ, thank_countが0と等しい場合はthankが押せる
            $is_thank[$comment['id']] = true;
        }
    }
}

if ($dream_user === $user_id) {
    $is_my_dream = true;
}

$user_info = select_user_from_user_id($dbh, $user_id);
if ($user_info === null) {
  echo 'error get user info on top';
  exit();
}
$user_page_url = get_user_page_url($user_info);

$dbh = null;

if (isset($dream) === true) {
  include_once(TMPL_DIR . '/dream.html.php');
} else {
  echo 'Error... Not found DREAM ID.';
}
