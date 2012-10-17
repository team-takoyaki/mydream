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

function insert_dream($dbh, $title, $body, $category, $user_id) {
  $sql = 'insert into dr_dream(title, body, category, user_id) values(:title, :body, :category, :user_id)';
  try {
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':title' => $title, ':body' => $body, ':category' => $category, ':user_id' => $user_id));
  } catch (PDOException $e) {
      return null;
  }
  return true;
}

function select_dreams($dbh) {
  $sql = 'select id, title, category from dr_dream';
  try {
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
  } catch (PDOException $e) {
      return null;
  }
  return $result;
}

function select_dream_from_dream_id($dbh, $dream_id) {
  $sql = 'select id, title, body, category from dr_dream where id = :id';
  try {
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':id' => $dream_id));
    $result = $stmt->fetch();
  } catch (PDOException $e) {
      return null;
  }
  return $result;
}

//search dream in category
function select_dream_from_category($dbh, $category) {
    $sql = 'select title, body, category, user_id from dr_dream where category = :category';
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':category' => $category
            )
        );
        $result = $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
    return $result;
}
