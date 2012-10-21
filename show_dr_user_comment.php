<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
$dbh = connect_db();
try {
    $sql = 'select * from dr_dream_comment';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    var_dump($result);
} catch (PDOException $e) {
    var_dump($e->getMessage());
}
