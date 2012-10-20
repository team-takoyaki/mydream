<?php
require_once('const.php');
require_once('lib/model.php');

$dbh = connect_db();
//$sql = 'insert into dr_category(category_name) values(:name)';
$sql = 'select * from dr_category';
$stmt = $dbh->prepare($sql);
//$stmt->execute(array(':name' => 'social'));
$stmt->execute();
$result = $stmt->fetchAll();
var_dump($result);
