<?php
require_once('const.php');
session_start();
?><!DOCTYPE html>
<header>
    <meta charset="utf-8">
    <title>Doing</title>
    <link rel="stylesheet" type="text/css" href="css/top.css">
</header>
<body>
    <p>
        Hello <?= $_SESSION['up']->users['user_name'];?>
    </p>
    <p>
        <a href="<?= $_SESSION['up']->users['user_page'];?>" target="_blank">
            <img src="<?= $_SESSION['up']->users['user_icon'];?>">
        </a>
    </p>
    <p>写真がリンク</p>
    <p>
        <button id="location_movie" class="location_button">映画を見てる</button>
    </p>
    <p>
        <a href="logout.php">Logout</a>
    </p>
    <script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="scripts/geolocation.js"></script>
    <script type="text/javascript" src="scripts/top.js"></script>
</body>
</html>
