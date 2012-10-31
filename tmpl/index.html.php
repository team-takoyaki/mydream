<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ぼくの夢リスト</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">
    <link rel="apple-touch-icon-precomposed" href="images/touch-icon-iphone.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/touch-icon-iphone4.png">
    <link rel="shortcut icon" href="images/favicon.ico">
</head>
<body>
    <div id="body">
        <nav>
            <div class="top_actions_message">
                ログインする
            </div>
            <ul class="top_actions">
                <li class="action">
                    <a href="login_t.php">
                        <img src="images/twitter_logo.png" alt="Twitterでログインする">
                    </a>
                </li>
                <li class="action">
                    <a href="login_f.php">
                        <img src="images/facebook_logo.png" alt="facebookでログインする">
                    </a>
                </li>
            </ul>
            <ul class="user_actions">
                <li class="action">
                    <a href="search.php">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/search.png">
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="site_title">
            <h1><img src="images/logo.png" class="ぼくの夢リスト"></h1>
            <h2>みんなで作る夢のページ</h2>
        </div>
        <?php if (count($dreams) > 0) { ?>
        <div class="dreams_message">
            <h3>おすすめの夢リスト</h3>
        </div>
        <ul class="dreams">
            <?php foreach($dreams as $dream) {?>
            <a href="<?= BASE_URL . '/dream.php?id=' . $dream['id'];?>">
                <li class="dream">
                    <div class="dream_info">
                        <div class="dream_title">
                            <?= $dream['title'];?>
                        </div>
                    </div>
                </li>
                    </a>
            <?php }?>
        </ul>
        <?php } ?>
    </div>
</body>
</html>
