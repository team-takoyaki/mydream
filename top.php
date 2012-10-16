<?php
require_once('profile.php');
session_start();
$up = new UserProfile();
var_dump($up);
if (isset($_SESSION['user_name'])) {
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
