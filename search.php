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

if (isset($_GET['category_id']) === true && $_GET['category_id'] !== '') {
  $category_id = intval($_GET['category_id']);
} else {
  $category_id = CATEGORY_DEFAULT_ID;
}

$dbh = connect_db();
show_error_db($dbh);

//夢情報の取得
$dreams = select_dream_from_category_id($dbh, $category_id);
if ($dreams === null) {
  echo 'error dreams or category_id on top';
  exit();
}

$user_info = select_user_from_user_id($dbh, $user_id);
if ($user_info === null) {
  echo 'error get user info on top';
  exit();
}
$user_page_url = get_user_page_url($user_info);

$dbh = null;

$selected = array($category_id => 'selected');

include_once(TMPL_DIR . '/search.html.php');

