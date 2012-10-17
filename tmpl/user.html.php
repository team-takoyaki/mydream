<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>My Dream, Your Dream</title>
    <link rel="stylesheet" type="text/css" href="css/write_dream.css">
</head>
<body>
    <p>
        Hello <?= $user_name;?>
    </p>
    <img src="<?= $user_image; ?>">
    <?php if (count($dreams) > 0) { ?>
       <ul>
       <?php foreach ($dreams as $dream) { ?>
           <li><a href="<?= DREAM_PHP ?>?id=<?= $dream['id'] ?>"><?= $dream['title'] ?></a></li>
       <?php } ?>
       </ul>
    <?php } ?>
</body>
</html>
