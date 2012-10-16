<?php
require_once('profile.php');
session_start();
$up = new UserProfile();
var_dump($_SESSION['up']);
if (isset($_SESSION['up']->users['user_name'])) {
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
