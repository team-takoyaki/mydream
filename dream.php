<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();
$is_my_dream = false;
if (isset($_GET['id']) === true && $_GET['id'] !== '') {
    $dream_id = intval($_GET['id']);
}


if (isset($_POST['user_comment']) === true && $_POST['user_comment'] !== '') {
    $user_comment = $_POST['user_comment'];
}

$dbh = connect_db();
if (isset($user_comment) === true) {
    insert_comment($dbh, $user_comment, $_SESSION['user_id'], $dream_id);
}

if (isset($dream_id) === true && check_dream_id($dream_id) !== null) {
    $dream = select_dream_from_dream_id($dbh, $dream_id);
    $dream_user = select_user_id_from_dream_id($dbh, $dream_id);
    $comments = select_comments_from_dream_id($dbh, $dream_id);
}

if ($dream_user === $_SESSION['user_id']) {
    $is_my_dream = true;
}

if (isset($dream) === true) {
  include_once(TMPL_DIR . '/dream.html.php');
} else {
  echo 'Error... Not found DREAM ID.';
}
