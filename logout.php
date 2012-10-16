<?php
session_start();
if (isset($_SESSION['up'])) {
    session_destroy();
}
header('Location:http://team-takoyaki.com/dream/');
