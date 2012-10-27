<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ぼくの夢リスト</title>
    <link rel="stylesheet" type="text/css" href="css/top.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<body>
    <div id="body">
        <nav>
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
        </nav>

        <?php if (count($user_dreams) > 0) { ?>
        <div class="dreams_message">
            <h3>更新された夢リスト</h3>
        </div>
        <ul class="dreams">
            <?php foreach($user_dreams as $dream) {?>
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
