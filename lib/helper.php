<?php

function check_dream_id($dream_id) {
    if (preg_match('/^[0-9]+$/', $dream_id) === 1) {
        return $dream_id;
    }
    return null;
}

function set_selected_category($data, $user_choice) {
    if ($data === $user_choice) {
        echo 'selected';
    }
}

function set_linked_from_text($text) {
    return preg_replace('{(http:\/\/.+?(?:\s|$))}i', '<a href="$1">$1</a>', htmlspecialchars($text));
}
