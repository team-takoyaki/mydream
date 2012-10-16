<?php
require_once('profile.php');
session_start();
$up = new UserProfile();
var_dump($up->get_users());
if (isset($_SESSION['up'])) {
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
