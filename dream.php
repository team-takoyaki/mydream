<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

if (isset($_SESSION['user_id']) === true && $_SESSION['user_id'] !== '') {
    $user_id = $_SESSION['user_id'];
}

if (isset($_GET['id']) === true && $_GET['id'] !== '') {
    $dream_id = intval($_GET['id']);
}

if (isset($_GET['comment_id']) === true && $_GET['comment_id'] !== '') {
    $update_comment_id = intval($_GET['comment_id']);
}

if (isset($_POST['comment_submit']) === true && $_POST['comment_submit'] !== '') {
    $comment_submit = $_POST['comment_submit'];
}

if (isset($_POST['comment']) === true && $_POST['comment'] !== '') {
    $comment = $_POST['comment'];
}

if (isset($_POST['thanks_submit']) === true && $_POST['thanks_submit'] !== '') {
    $thanks_submit = $_POST['thanks_submit'];
}

if (isset($_POST['comment_id']) === true && $_POST['comment_id'] !== '') {
    $comment_id = $_POST['comment_id'];
}

if (isset($_POST['cheers_submit']) === true && $_POST['cheers_submit'] !== '') {
    $cheers_submit = $_POST['cheers_submit'];
}

if (isset($_POST['order_change']) === true && $_POST['order_change'] !== '') {
    $order_change = $_POST['order_change'];
}

if (isset($_POST['order_comment_ids']) === true && $_POST['order_comment_ids'] !== '') {
    $order_comment_ids = $_POST['order_comment_ids'];
}

if (isset($order_change) === false && check_dream_id($dream_id) === false) {
    echo '不正なアクセスです';
    exit;
}

if (isset($update_comment_id) === true && check_dream_id($update_comment_id) === false) {
    echo '不正なアクセスです';
    exit;
}

$dbh = connect_db();
show_error_db($dbh);

if (isset($comment_submit) === true && isset($comment) === true) {
    $update_comment_id = intval(insert_comment($dbh, $comment, $user_id, $dream_id));
    if ($update_comment_id === null) {
        echo 'コメントを書き込めませんでした';
        exit;
    }
}

if (isset($update_comment_id) === true) {
    $comment = select_comment_from_comment_id($dbh, $update_comment_id);
    if ($comment['status_flg'] !== 0) {
        $tweet_text = get_tweet_message($comment['body']);
    }
}

if (isset($order_change) === true && isset($order_comment_ids) === true) {
    $num = 1;
    foreach ($order_comment_ids as $comment_id) {
        update_comment_order($dbh, $comment_id, $num);
        $num += 1;
    }
    print "200";
    exit;
}

if (isset($user_id) === true && isset($comment_id) === true) {
    $is_thank_by_user_id = check_thank_user_from_comment_id_and_user_id($dbh, $comment_id, $user_id);
    if ($is_thank_by_user_id === null) {
        echo 'ありがとうの数の取得に失敗しました';
        exit;
    }
}

if (isset($thanks_submit) === true && isset($is_thank_by_user_id) === true && $is_thank_by_user_id === 0) {
    if (insert_thank($dbh, $comment_id, $user_id) === null) {
        echo 'ありがとうを押せませんでした';
        exit;
    }
}

$is_cheer_by_user_id = check_cheer_user_from_dream_id_and_user_id($dbh, $dream_id, $user_id);
if ($is_cheer_by_user_id === null) {
    echo '応援の数の取得に失敗しました';
    exit;
}

if (isset($user_id) === true && isset($cheers_submit) === true && 
    isset($is_cheer_by_user_id) === true && $is_cheer_by_user_id === true) {
    if (insert_cheer($dbh, $dream_id, $user_id) === null) {
        echo 'がんばれを押せませんでした';
        exit;
    }
    $is_cheer_by_user_id = false;
}

$cheer_users_count = select_cheer_count_from_dream_id($dbh, $dream_id);
if ($cheer_users_count === null) {
    echo '応援の数の取得に失敗しました';
    exit;
}

$dream = select_dream_from_dream_id($dbh, $dream_id);
if ($dream === null) {
    echo '夢を取得できませんでした';
    exit;
}

/*print $dream;*/
/* $dream_user = $dream['user_id']; */

$comments = select_comments_from_dream_id($dbh, $dream_id);
if ($comments === null) {
    echo 'コメントを取得できませんでした';
    exit;
}

$is_thank_by_comment_id = array();
if (isset($user_id) === true) {
    foreach ($comments as $comment) {
        $thank_count = check_thank_user_from_comment_id_and_user_id($dbh, $comment['id'], $user_id);
        if ($thank_count === null) {
            echo 'ありがとうの数の取得に失敗しました';
            exit;
        }

        if ($thank_count === 0 && $user_id !== $comment['user_id']) {
            $is_thank_by_comment_id[$comment['id']] = true;
        } else {
            $is_thank_by_comment_id[$comment['id']] = false;
        }
    }
}

if (isset($user_id) === true) {
    $user_info = select_user_from_user_id($dbh, $user_id);
    if ($user_info === null) {
        echo 'ユーザー情報が取得できませんでした';
        exit;
    }
    $user_name = $user_info['user_name'];
    /* $user_page_url = get_user_page_url($user_info); */
}

$dbh = null;

include_once(TMPL_DIR . '/dream.html.php');
