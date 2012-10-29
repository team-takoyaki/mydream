<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>ぼくの夢リスト</title>
        <link rel="stylesheet" type="text/css" href="css/dream.css">
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

        <div class="dream">
            <div class="dream_info">
                <div class="dream_title">
                    <?= htmlspecialchars($dream['title']); ?>
                </div>
            </div>
        </div>
        <?php if (isset($user_id) === true) { ?>
        <div class="dream_tool">
            <form method="POST" class="cheers_btn_form">
                <?php if ($is_cheer_by_user_id === true) { ?>
                <button name="cheers_submit" class="cheers_btn" value="1">がんばれ</button>
                <?php } else { ?>
                <button name="cheers_submit" class="cheers_btn" value="1" disabled>応援中</button>
                <?php } ?>
            </form>
            <?php if ($cheer_users_count > 0) { ?>
            <div class="cheers_message">
                <?= $cheer_users_count ?>人が応援中
            </div>
            <?php } ?>
            <?php if (count($comments) > 0) { ?>
            <div class="order_save">
                <button class="order_edit_btn" name="order_edit">順番を変える</button>
                <button class="order_save_btn display_none" name="order_save">保存</button>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="comments_wrapper">
            <ul class="comments sortable">
                <?php $num = 0; ?>
                <?php foreach ($comments as $comment) { ?>
                <?php $num += 1; ?>
                <li class="ui-state-default">
                    <div class="comment"  data-comment-id="<?= $comment['id'] ?>">
                    <?php if ($comment['status_flg'] !== 0) { ?>
                    <p><?= set_html_from_text($comment['body']); ?></p>
                    <?php } ?>
                    <?php if (isset($user_id) === true) { ?>
                    <div class="comment_tool">
                    <?php if (isset($tweet_text) === true && $update_comment_id === $comment['id']) { ?>
                    <div class="tweet_btn">
                        <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://team-takoyaki.com/dream/" data-text="<?= $tweet_text ?>" data-lang="ja" data-size="large" data-count="none">ツイート</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                    <?php } ?>
                        <a href="<?= BASE_URL ?>/comment.php?id=<?= $comment['id'] ?>">
                            <button class="edit_btn" value="edit">編集する</button>
                        </a>
                        <!-- <form method="POST" class="thanks_btn_form"> -->
                        <!--     <input type="hidden" name="comment_id" value="<?= $comment['id']; ?>"> -->
                        <!--     <?php if ($is_thank_by_comment_id[$comment['id']] === true) { ?> -->
                        <!--     <button name="thanks_submit" class="thanks_btn" value="1">メモる</button> -->
                        <!--     <?php } else { ?> -->
                        <!--     <button name="thanks_submit" class="thanks_btn" value="1" disabled>メモってます</button> -->
                        <!--     <?php } ?> -->
                        <!-- </form> -->
                    </div>
                    <?php } ?>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <?php if (isset($user_id) === true) { ?>
            <form method="POST" class="comment_form">
                <textarea name="comment" class="user_comment"></textarea>
                <button name="comment_submit" class="comment_submit" value="1">投稿</button>
            </form>
            <?php } ?>
        </div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js"></script>
        <script src="js/dream.js"></script>
    </body>
</html>
