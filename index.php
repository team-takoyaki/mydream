<?php
require_once(dirname(__FILE__) . '/lib/model.php');
session_start();

$dbh = connect_db();
$sql = 'insert into dr_user_info(user_name, user_image, access_token) values(:user_name, :user_image, :access_token)';
try {
  $stmt = $dbh->prepare($sql);
  $stmt->execute(array(':user_name' => 'hello', ':user_image' => 'world.jpg', ':access_token' => 'hello'));
} catch (PDOException $e) {
  echo $e->getMessage();
}

echo 'Finished!!!';

if (isset($_SESSION['user_name'])) {
    header('Location:http://team-takoyaki.com/dream/top.php');
} else {
    include_once('tmpl/index.html.php');
}

