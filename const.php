<?php
define('BASE', dirname(__FILE__));

define('BASE_URL', 'http://team-takoyaki.com/dev/dream');

// kashima debug url
define('DEBUG_BASE_URL', 'http://unuuu.com/dev/dream');

define('DREAM_PHP', BASE_URL . '/dream.php');
define('USER_PHP', BASE_URL . '/user.php');

define('TMPL_DIR', 'tmpl');
define('IMAGES_DIR', 'images');

define('FB_PERMISSION' , 'publish_stream, read_friendlists');

define('DR_SNS_FACEBOOK', 'facebook');
define('DR_SNS_TWITTER', 'twitter');

define('CATEGORY_DEFAULT_ID', 1);

define('TWITTER_HASH', '#takoyaki_dream');

define('DREAM_TITLE_MAX', 10);

define('DREAM_DISPLAY_MAX', 5);

define('ERROR_NOT_FILL', '入力されていない項目があります');
define('ERROR_WRONG_MAX_TITLE', 'タイトルは' . DREAM_TITLE_MAX . '字以内で入力して下さい');


$categories = array('', '社会', 'スポーツ', '音楽', 'エンターテインメント', '科学', 'コンピュータ', 'ゲーム・アニメ', 'その他');
