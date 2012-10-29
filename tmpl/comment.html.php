<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ぼくの夢リスト</title>
        <link rel="stylesheet" type="text/css" href="css/comment.css">
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
            <?php if (isset($user_name) === true) { ?>
            <div class="top_actions_message">
                こんにちは、<a href="<?= BASE_URL ?>/top.php"><?= $user_name ?>さん</a>
            </div>
            <?php } ?>
            <ul class="user_actions">
                <?php if (isset($user_id) === true) { ?>
                <li class="action">
                    <a href="<?= BASE_URL ?>/add.php">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/write.png">
                        </span>
                    </a>
                </li>
                <?php } ?>
                <?php if (isset($user_name) === false) { ?>
                <li class="action">
                    <a href="<?= BASE_URL ?>/">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/home.png">
                        </span>
                    </a>
                </li>
                <?php } ?>
                <li class="action">
                    <a href="<?= BASE_URL ?>/search.php">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/search.png">
                        </span>
                    </a>
                </li>
                <?php if (isset($user_id) === true) { ?>
                <li class="action">
                    <a href="<?= BASE_URL ?>/logout.php" class="logout_btn">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/logout.png">
                        </span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </nav>

        <div class="comment"  data-comment-id="<?= $comment['id'] ?>">
            <form method="POST">
                <textarea name="comment"><?= $comment['body']; ?></textarea>
                <div class="comment_tool">
                    <?php if ($comment['status_flg'] === 0) { ?>
                    <button class="update_btn" name="public_submit" value="edit">公開する</button>
                    <?php } else { ?>
                    <button class="update_btn" name="unpublic_submit" value="edit">非公開にする</button>
                    <?php } ?>
                    <button class="update_btn" name="update_submit" value="edit">更新する</button>
                </div>
            </form>
        </div>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="js/comment.js"></script>
    </body>
</html>
