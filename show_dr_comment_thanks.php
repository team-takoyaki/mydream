<?php
require_once('const.php');
require_once('lib/model.php');
$dbh = connect_db();
$sql = 'select * from dr_comment_thank';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
var_dump($result);
