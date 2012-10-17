<?php
require_once('const.php');
session_start();
$users = unserialize($_SESSION['up']);
?><!DOCTYPE html>
<header>
    <meta charset="utf-8">
    <title>Doing</title>
    <link rel="stylesheet" type="text/css" href="css/top.css">
</header>
<body>
    <p>
        Hello <?= $users->users['user_name'];?>
    </p>
    <p>
        <a href="<?= $users->users['user_page'];?>" target="_blank">
            <img src="<?= $users->users['user_icon'];?>">
        </a>
    </p>
    <p>写真がリンク</p>
    <p>
        <button id="location_movie" class="location_button">映画を見てる</button>
    </p>
    <p>
        <a href="<?= 'write_dream.php';?>">write dream</a>
    </p>
    <p>
        <a href="logout.php">Logout</a>
    </p>
    <script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="scripts/geolocation.js"></script>
    <script type="text/javascript" src="scripts/top.js"></script>
</body>
</html>
