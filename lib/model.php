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

function insert_user($dbh, $user_name, $user_image, $sns_id, $sns_user_id) {
    $select_sql = 'select id from dr_user where sns_id = :sns_id and sns_user_id = :sns_user_id';
    $insert_sql = 'insert into dr_user(user_name, user_image, sns_id, sns_user_id) values(:user_name, :user_image, :sns_id, :sns_user_id)';
    try {
        $stmt = $dbh->prepare($select_sql);
        $stmt->execute(
            array(
                ':sns_id' => $sns_id,
                ':sns_user_id' => $sns_user_id
            )
        );
        $res = $stmt->fetch();
        if (isset($res['id']) === true) {
            //二重登録防ぐ処理
            return $res['id'];
        }
        $stmt = $dbh->prepare($insert_sql);
        $stmt->execute(
            array(
                ':user_name' => $user_name,
                ':user_image' => $user_image,
                ':sns_id' => $sns_id,
                ':sns_user_id' => $sns_user_id
            )
        );
    } catch (PDOException $e) {
        return null;
    }
  return $dbh->lastInsertId('dr_user_id_seq');
}

function select_user_is_regited($dbh, $sns_id, $sns) {
    $sql = 'select count(user_name) from dr_user where sns_id = :sns_id and sns = :sns'
;
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':sns_id' => $sns_id,
                ':sns' => $sns
            )
        );
        $result = $stmt->fetch();
        if (intval($result) > 0) {
            return true;
        }
        return false;
    } catch (PDOException $e) {
        return null;
    }
}

function select_user_from_user_id($dbh, $user_id) {
  $sql = 'select id, user_name, user_image, sns_id, sns_user_id from dr_user where id = :id';
  try {
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':id' => $user_id));
    $result = $stmt->fetch();
    var_dump($result);
  } catch (PDOException $e) {
      return null;
  }
  return $result;
}

function select_dreams_from_user_id($dbh, $user_id) {
  $sql = 'select id, title, body, category from dr_dream where user_id = :user_id';
  try {
    $stmt = $dbh->prepare($sql);
    $stmt->execute(array(':user_id' => $user_id));
    $result = $stmt->fetchAll();
  } catch (PDOException $e) {
      return null;
  }
  return $result;
}

function select_sns_id_from_sns_name($dbh, $sns_name) {
    $sql = 'select id from dr_sns where sns_name = :sns_name';
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':sns_name' => $sns_name
            )
        );
        $result = $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
    return $result;
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
    $sql = 'select id, title, body, category, user_id from dr_dream where category = :category';
    //$sql = 'select t1.id, t1.title, t1.body, t1.category, t1.user_id, t2.user_name from dr_dream t1 inner join dr_user t2 on t1.user_id = t2.id where category = :category';
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':category' => $category
            )
        );
        $result = $stmt->fetchAll();
    } catch (PDOException $e) {
        return null;
    }
    return $result;
}


function select_id_from_dr_user($dbh, $sns_name, $sns_user_id) {
    $sql = 'select id from dr_user t1 inner join dr_sns t2 on t2.id = t1.sns_id where t1.sns_user_id = :sns_user_id and t2.sns_name = :sns_name';
    try {
        $stmt = $dbh->prepare($sql);
        $stmt->execute(
            array(
                ':sns_user_id' => $sns_user_id,
                ':sns_name' => 'sns_name'
            )
        );
        $result = $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
    return $result;
}

function select_users($dbh) {
  $sql = 'select id, user_name, user_image from dr_user';
  try {
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
  } catch (PDOException $e) {
      return null;
  }
  return $result;
}
