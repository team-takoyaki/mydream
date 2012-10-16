<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');

if (isset($_POST['title']) === true && $_POST['title'] !== '') {
    $title = trim($_POST['title']);
}

if (isset($_POST['body']) === true && $_POST['body'] !== '') {
    $body = trim($_POST['body']);
}

if (isset($_POST['category']) === true && $_POST['category'] !== '') {
    $category = trim($_POST['category']);
}

if (isset($title) === true && isset($body) === true && isset($category) === true) { 
    $dbh = connect_db();
    // debug
    $user_id = rand(1, 999);
    $dream_list_id = insert_dream_list($dbh, $user_id);
    insert_dream($dbh, $dream_list_id, $title, $body, $category);
    echo 'Finish';
} else {
    include_once('tmpl/write_dream.html.php');
}