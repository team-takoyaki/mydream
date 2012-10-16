<?php
require_once(dirname(__FILE__) . '/lib/model.php');

$dbh = connect_db();
$sql = 'insert into dr_user_info(user_name, user_image, access_token) values(:user_name, :user_image, :access_token)';
try {
  $stmt = $dbh->prepare($sql);
  $stmt->execute(array(':user_name' => 'hello', ':user_image' => 'world.jpg', ':access_token' => 'hello'));
} catch (PDOException $e) {
  echo $e->getMessage();
}

echo 'Finished!!!';