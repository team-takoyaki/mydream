<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title><?= $dream['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="css/write_dream.css">
</head>
<body>
    <h1><?= htmlspecialchars($dream['title']); ?></h1>
    <p>body <?= set_linked_from_text($dream['body']); ?></p>
    <p>By <?= htmlspecialchars($dream['user_name']); ?></p>
    <?php if ($is_my_dream === false) {?>
    <form method="POST">
        <p><button name="cheers" value="cheers">Cheers</button></p>
        <?php if ($cheer_users > 0) { ?>
        This post cheer by <?= htmlspecialchars($cheer_users) ?> users;
        <?php } ?>
    </form>
    <?php }?>
    <?php foreach ($comments as $comment) { ?>
    <div class="comment">
        <p><?= set_linked_from_text($comment['body']); ?></p>
        <p><?= htmlspecialchars($comment['user_name']); ?></p>
         <form method="POST">
            <p><button name="comment_id" value="<?= $comment['id']; ?>"<?php display_button($is_thank[$comment['id']]);?>>Thanks</button></p>
            <?php if ($thank_users[$comment['id']] > 0) { ?>
            This post thanks by <?= htmlspecialchars($thank_users[$comment['id']]) ?> users;
            <?php } ?>
         </form>
    </div>
    <?php } ?>
    <form method="POST">
        <textarea name="user_comment"></textarea>
        <button name="post">投稿</button>
    </form>
</body>
</html>
