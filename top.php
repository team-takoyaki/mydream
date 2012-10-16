<?php
session_start();
if (isset($_SESSION['user_name'])) {
    var_dump($_SESSION);
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
