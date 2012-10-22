<?php

function check_dream_id($dream_id) {
    if (preg_match('/^[0-9]+$/', $dream_id) === 1) {
        return $dream_id;
    }
    return null;
}

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

function set_selected_category($data, $user_choice) {
    if ($data === $user_choice) {
        echo htmlspecialchars('selected');
    }
}

function set_linked_from_text($text) {
    return preg_replace('{(http:\/\/.+?(?:\s|$))}i', '<a href="$1">$1</a>', htmlspecialchars($text));
}
