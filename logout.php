<?php
session_start();
if (isset($_SESSION['user_name'])) {
    session_destroy();
}
header('Location:http://team-takoyaki.com/dream/');
