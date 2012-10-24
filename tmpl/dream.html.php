<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title><?= $dream['title']; ?></title>
        <link rel="stylesheet" type="text/css" href="css/dream.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    </head>
    <body>
        <div id="body">
            <a href="<?= BASE_URL ?>">
                <header>
                    <h1><?= $user_info['user_name'];?>の夢リスト</h1>
                    <div class="user_image">
                        <img src="<?= $user_info['user_image'];?>">
                    </div>
                </header>
            </a>
            <div class="dream_wrapper">
                <div class="dream">
                    <div class="dream_inner">
                        <h1><?= htmlspecialchars($dream['title']); ?></h1>
                        <p class="dream_body">body <?= set_linked_from_text($dream['body']); ?></p>
                        <div class="author_wrapper"><span class="author"><?= htmlspecialchars($dream['user_name']); ?></span></div>
                        <?php if ($is_my_dream === false) {?>
                        <form method="POST" class="cheers_btn_form">
                            <button name="cheers" value="cheers" class="cheers_btn">応援する</button>
                            <?php if ($cheer_users > 0) { ?>}
                                <p class="cheers_message"><?= htmlspecialchars($cheer_users) ?>が応援しています</p>
                            <?php } ?>
                        </form>
                    <?php }?>
                    </div>
                    <?php foreach ($comments as $comment) { ?>
                    <div class="comment">
                        <p class="comment_body"><?= set_linked_from_text($comment['body']); ?></p>
                        <div class="comment_author"><?= htmlspecialchars($comment['user_name']); ?></div>
                        <form method="POST" class="thanks_btn_form">
                            <button name="comment_id" class="thanks_btn" value="<?= $comment['id']; ?>"<?php display_button($is_thank[$comment['id']]);?>>ありがとう</button>
                            <?php if ($thank_users[$comment['id']] > 0) { ?>
                            <p class="thanks_message"><?= htmlspecialchars($thank_users[$comment['id']]); ?>がありがとうと言っています</p>
                            <?php } ?>
                        </form>
                    </div>
                    <?php } ?>
                    <form method="POST" class="comment_form">
                        <textarea name="user_comment" class="user_comment"></textarea>
                        <button name="post" class="submit">投稿</button>
                    </form>
                </div>
                <ul class="user_actions">
                    <li class="action">
                        <a href="add.php">
                            <span class="action_name">
                                <img src="<?= IMAGES_DIR ?>/write.png">
                                夢を書く
                            </span>
                        </a>
                    </li>
                    <li class="action">
                        <a href="search.php">
                            <span class="action_name">
                                <img src="<?= IMAGES_DIR ?>/search.png">
                                夢を検索する
                            </span>
                        </a>
                    </li>
                    <li class="action">
                        <a href="logout.php">
                            <span class="action_name">
                                <img src="<?= IMAGES_DIR ?>/logout.png">
                                ログアウト
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
    </body>
</html>
