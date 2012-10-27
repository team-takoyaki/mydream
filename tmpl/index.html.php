<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ぼくの夢リスト</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<body>
    <div id="body">
        <nav>
            <?php if (isset($user_name) === true && $user_name !== '') { ?>
            <div class="top_actions_message">
                こんにちは、<a href="top.php"><?= $user_name ?>さん</a>
            </div>
            <ul class="user_actions">
                <li class="action">
                    <a href="add.php">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/write.png">
                        </span>
                    </a>
                </li>
                <li class="action">
                    <a href="search.php">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/search.png">
                        </span>
                    </a>
                </li>
                <li class="action">
                    <a href="logout.php">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/logout.png">
                        </span>
                    </a>
                </li>
            </ul>
            <?php } else { ?>
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
            <?php } ?>
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
            <a href="<?= BASE_URL . '/dream.php?id=<?= $dream['id'];?>">
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
    <!--     <div id="title_logo"></div> -->
    <!--         <\!-- <?php if ($is_login === true) {?> -\-> -->
    <!--         <\!--     <li class="action"> -\-> -->
    <!--         <\!--         <a href="<?= $post_url;?>"> -\-> -->
    <!--         <\!--             <span class="action_name"> -\-> -->
    <!--         <\!--             SNSに書き込む -\-> -->
    <!--         <\!--             </span> -\-> -->
    <!--         <\!--         </a> -\-> -->
    <!--         <\!--     </li> -\-> -->
    <!--         <\!--     <li class="action"> -\-> -->
    <!--         <\!--         <a href="logout.php"> -\-> -->
    <!--         <\!--             <span class="action_name"> -\-> -->
    <!--         <\!--                 ログアウト -\-> -->
    <!--         <\!--             </span> -\-> -->
    <!--         <\!--         </a> -\-> -->
    <!--         <\!--     </li> -\-> -->
    <!--         <\!-- <?php } else {?> -\-> -->
    <!--         <\!-- <?php }?> -\-> -->
    <!--     </ul> -->
    <!-- </div> -->
    </div>
    <script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="scripts/index.js"></script>
</body>
</html>
