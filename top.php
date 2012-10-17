<?php
require_once('const.php');
session_start();
if (isset($_SESSION['up'])) {
    include_once('tmpl/top.html.php');
} else {
    header('Location:' . BASE_URL);
}
