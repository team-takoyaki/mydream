<?php
require_once('const.php');
require_once(BASE . '/lib/model.php');
require_once(BASE . '/lib/helper.php');
require('facebook/facebook.php');
session_start();

$facebook = new Facebook(
    array(
        'appId'  => '124401297710327',
        'secret' => '9e5d861e6031580f4af546158f352b84',
    )
);

if (isset($_SESSION['f']['access_token']) === true) {
    $access_token = $_SESSION['f']['access_token'];
} else {
    echo 'error on session twitter';
    exit();
}

try {
    //ウォールへ投稿
    $result = $facebook->api(
                    '/me/feed',
                    'post',
                    array(
                        'message' => 'test post',
//                        'picture' => 'our icon url',
                        'link' => 'http://team-takoyaki.com/dream',
                        'name' => '僕の夢リスト',
                        'caption' => 'caption',
                        'description' => 'desctiption',
//                        'source' => 'souce_url',
                        'action' => json_encode(
                            array(
                                'name' => '僕の夢リスト？？？',
                                'link' => 'http://team-takoyaki.com/dream'
                            )
                        )
                    )
                );
} catch(FacebookApiException $e) {
    echo 'error on facebook api post';
    exit();
}

//とりあえずindexにリダイレクト
header('Location:' . BASE_URL);
