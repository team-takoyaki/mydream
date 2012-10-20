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
   <?php //foreach($comments as $comment) { ?>
   <div>
       <h2><?= $comment['user_name']; ?></h2>
       <p><?= $comment['body']; ?></p>
   </div>
   <?php //} ?>
   <form method="POST">
       <textarea name="user_comment"></textarea>
       <button name="post">投稿</button>
   </form>
</body>
</html>
