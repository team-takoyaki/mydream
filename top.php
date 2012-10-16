<?php
require_once('profile.php');
session_start();
var_dump($_SESSON['up']);
if (isset($_SESSION['up'])) {
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
