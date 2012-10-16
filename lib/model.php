<?php

function connect_db() {
    try {
        $dsn = 'pgsql:host=localhost; dbname=dr_db; user=takoyaki; password=takoyaki0519;';
        $dbh = new PDO($dsn);
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        return null;
    }
    return $dbh;
}

function insert_dream_list($dbh, $user_id) {
  $sql = 'insert into dr_dream_list(user_id) values(:user_id)';  
  try {
    $stmt = $dbh->prepare($sql);  
    $stmt->execute(array(':user_id' => $user_id));
    $dream_list_id = $dbh->lastInsertId('dr_dream_list_dream_list_id_seq');
  } catch (PDOException $e) {
    return null;
  }
  return $dream_list_id;
}

function insert_dream($dbh, $dream_list_id, $title, $body, $category) {
  $sql = 'insert into dr_dream(dream_list_id, title, body, category) values(:dream_list_id, :title, :body, :category)';
  try {
    $stmt_dream = $dbh->prepare($sql);  
    $stmt_dream->execute(array(':dream_list_id' => $dream_list_id, ':title' => $title, ':body' => $body, ':category' => $category));  
  } catch (PDOException $e) {
      return null;
  }
  return true;
}