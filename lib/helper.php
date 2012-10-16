<?php

function make_icon_url($sns, $user_id) {
    $icon_path = '';
    if ($sns === 'twitter') {
        $icon_path = 'http://api.twitter.com/1/users/profile_image?screen_name=' . $user_id . '&size=normal';
    } else if ($sns === 'facebook') {
        $icon_path = 'https://graph.facebook.com/' . $user_id . '/picture';
    }
    return $icon_path;
}
