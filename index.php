<?php
session_start();
if (isset($_SESSION['user_name'])) {
    header('Location:http://team-takoyaki.com/dream/top.php');
} else {
    include_once('tmpl/index.html.php');
}
