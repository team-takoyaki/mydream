<?php
session_start();
if (isset($_SESSION['user_name'])) {
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
