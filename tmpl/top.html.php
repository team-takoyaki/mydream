<?php
require_once('const.php');
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location:' . BASE_URL);
    exit();
}
?><!DOCTYPE html>
<header>
    <meta charset="utf-8">
    <title>Doing</title>
    <link rel="stylesheet" type="text/css" href="css/top.css">
</header>
<body>
    <p>
    <?php
        if (isset($_SESSION['user_name'])) {
    ?>
    Hello <?php echo $_SESSION['user_name'];?>
    <?php }?>
    </p>
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
