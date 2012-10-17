<?php
require_once('const.php');
require_once(BASE. '/lib/model.php');
session_start();

if (isset($_SESSION['up'])) {
    header('Location:' . BASE_URL . '/top.php');
} else {
    include_once('tmpl/index.html.php');
}

