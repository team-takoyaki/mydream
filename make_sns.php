<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');

/**
 *Debug
 */

$dbh = connect_db();
//$sql = 'insert into dr_sns(sns_name) values(:sns)';
//$stmt = $dbh->prepare($sql);
//$stmt->execute(array(':sns' => 'twitter'));
$sql = 'select * from dr_sns';
$stmt = $dbh->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();
var_dump($result);
