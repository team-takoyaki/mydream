<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location:http://team-takoyaki.com/doing');
    exit();
}
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Doing</title>
        <link rel="stylesheet" href="css/geolocation.css" type="text/css">
    </head>
    <body>
        <div id="wrap_doing">
            <div><textarea id="doing"></textarea></div>
            <div><button id="add">投稿</button></div>
        </div>
        <input id="user_name" type="hidden" value="<?php echo $_SESSION['user_name'];?>">
        <div id="map_canvas" class="display_none"></div>
        <ul id="spots" class="display_none"></ul>
        <p>
            <a href="http://team-takoyaki.com/doing/">TOPへ戻る</a>
        </p>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="scripts/geolocation.js"></script>
    </body>
</html>

