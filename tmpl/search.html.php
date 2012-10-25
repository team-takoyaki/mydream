<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>My Dream, Your Dream</title>
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<body>
    <div id="body">
    <a href="<?= BASE_URL ?>">
        <header>
        <h1>夢を検索する</h1>
        </header>
    </a>
    <form method="GET" class="search_form">
            <div class="item">
        <select name="category_id" class="category">
            <?php for($i = 1; $i < count($categories); $i++) { ?>
                    <option value="<?= $i ?>" <?= $selected[$i];?>><?= $categories[$i] ?></option>
            <?php } ?>
        </select>
            </div>
            <button class="submit">検索</button>
    </form>
        <?php if (count($dreams) > 0) { ?>
            <?php foreach($dreams as $dream) {?>
            <ul class="user_dreams">
        <a href="<?= BASE_URL . '/dream.php?id=' . $dream['id'];?>"><li class="dream">
            <?= $dream['title'];?>
        </li></a>
        </ul>
            <?php }?>
        <?php } ?>
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
        <a href="">
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
