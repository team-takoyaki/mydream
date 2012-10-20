<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

if (isset($_GET['id']) === true && $_GET['id'] !== '') {
    $dream_id = intval($_GET['id']);
}

$dbh = connect_db();
if (isset($_POST['post']) === true) {
    if (isset($_POST['user_comment']) === true && $_POST['user_coment'] !== '') {
        insert_comment($dbh, $_POST['user_comment'], $_SESSION['user_id'], $dream_id);
    }
}

if (isset($dream_id) === true && check_dream_id($dream_id) !== null) {
    $dream = select_dream_from_dream_id($dbh, $dream_id);
}

if (isset($dream) === true) {
  include_once(TMPL_DIR . '/dream.html.php');
} else {
  echo 'Error... Not found DREAM ID.';
}
