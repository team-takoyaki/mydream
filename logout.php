<?php
require_once('const.php');
session_start();
if (isset($_SESSION['user_id']) === true) {
//    session_destroy();
    $_SESSION['user_id'] = null;
}
header('Location:' . BASE_URL);
