<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
session_start();

//var_dump($_SESSION['t']);
//var_dump($_SESSION['f']);

/* post_url = null; */
if (isset($_SESSION['user_id']) === true && $_SESSION['user_id'] !== '') {
    header('Location:' . BASE_URL . '/top.php');
    exit;
}

$dbh = connect_db();
show_error_db($dbh);

/* if (isset($session_user_id) === true ) { */
/*     // ユーザー情報の取得 */
/*     $user_info = select_user_from_user_id($dbh, $session_user_id); */
/*     if ($user_info === null) { */
/*         echo 'ユーザー情報が取得できませんでした'; */
/*         exit(); */
/*     } */
/*     $user_name = $user_info['user_name']; */

/*     if ($user_info['sns_id'] === 1) { */
/*         $post_url = 'post_f.php'; */
/*     } else if ($user_info['sns_id'] === 2) { */
/*         $post_url = 'post_t.php'; */
/*     } */
/* } */

// 夢情報の取得
$dreams = select_id_and_title_from_dr_dream($dbh);
if ($dreams === null) {
    echo '夢を取得できませんでした';
    exit();
}

$dbh = null;

include_once(TMPL_DIR . '/index.html.php');
