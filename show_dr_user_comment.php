<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
$dbh = connect_db();
$sql = 'select count(*) from dr_dream_comment';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
var_dump($result);
