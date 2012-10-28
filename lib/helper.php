<?php

function display_button($flg) {
    if ($flg === false) {
        echo htmlspecialchars('disabled');
    }
}

function show_error_db($dbh) {
    if ($dbh === null) {
        include_once(TMPL_DIR . '/error_db.html.php');
        exit();
    }
}

function set_html_from_text($text) {
    $text = htmlspecialchars($text);
    $text = preg_replace('{\n}', '<br>', $text);
    /* $text = set_image_from_text($text); */
    $text = set_linked_from_text($text);
    return $text;
}

function set_linked_from_text($text) {
    return preg_replace('{(http:\/\/.+?(?:\s|$))}i', '<a href="$1">$1</a>', $text);
}

function set_image_from_text($text) {
    return preg_replace('{(http:\/\/[^\s]+?\.(:?jpg|png|gif))$}i', '<a href="$1"><img src="$1"></a>', $text);
}

function get_user_page_url($user_info) {
  if ($user_info['sns_id'] === 1) {
    //facebook
    $user_page = 'http://www.facebook.com/' . $users['sns_user_id'];
  } else if ($user_info['sns_id'] === 2) {
    //twitter
    $user_page = 'http://twitter.com/' . $users['user_name'];
  }
  return $user_page;
}

function check_dream_id($dream_id) {
    if (preg_match('/^([0-9]+)$/', $dream_id, $matches) === 1) {
        return $matches[1];
    }
    return false;
}

function check_dream_title($dream_title) {
    if (mb_strlen($dream_title, 'UTF-8') <= DREAM_TITLE_MAX) {
        return true;
    }
    return false;
}
