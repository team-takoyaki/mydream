<?php
//debug
require_once('const.php');
require_once('lib/model.php');
require_once('lib/helper.php');

$dbh = connect_db();
$sql = 'select * from dr_dream';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
var_dump($result);
$dbh = null;
