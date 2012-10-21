<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title><?= $dream['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="css/write_dream.css">
</head>
<body>
   <h1><?= $dream['title']; ?></h1>
   <p>body <?= $dream['body']; ?></p>
   <p>By <?= $dream['user_name']; ?></p>
   <?php foreach ($comments as $comment) { ?>
   <div class="comment">
        <p><?= $comment['body']; ?></p>
        <p><?= $comment['user_name']; ?></p>
        <?php if ($is_my_dream === false) {?>
         <form method="POST">
            <p><button name="comment_id" value="<?= $comment['id']; ?>">cheers</button></p>
            <?php if ($cheer_users[$comment['id']] > 0) { ?>
            This post cheer by <?= $cheer_users[$comment['id']] ?> users;
            <?php } ?>
         </form>
        <?php }?>
   </div>
   <?php } ?>
   <form method="POST">
       <textarea name="user_comment"></textarea>
       <button name="post">投稿</button>
   </form>
</body>
</html>
