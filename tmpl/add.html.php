<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ぼくの夢リスト</title>
    <link rel="stylesheet" type="text/css" href="css/add.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
</head>
<body>
    <div id="body">
        <nav>
            <div class="top_actions_message">
                こんにちは、<a href="<?= BASE_URL ?>/top.php"><?= $user_name ?>さん</a>
            </div>
            <ul class="user_actions">
                <li class="action">
                    <a href="<?= BASE_URL ?>/add.php">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/write.png">
                        </span>
                    </a>
                </li>
                <li class="action">
                    <a href="<?= BASE_URL ?>/search.php">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/search.png">
                        </span>
                    </a>
                </li>
                <li class="action">
                    <a href="<?= BASE_URL ?>/logout.php" class="logout_btn">
                        <span class="action_name">
                            <img src="<?= IMAGES_DIR ?>/logout.png">
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="dreams_message">
            <h3>新しい夢リストを作る</h3>
        </div>
        <?php if (isset($error_message) === true) { ?>
        <div class="careful">入力されていない項目があります</div>
        <?php } ?>
        <form method="POST" class="add_form">
            <input type="text" name="title" placeholder="タイトル" value="<?= $title ?>" class="add_title">
            <select name="category_id" class="add_category">
                <option value="">カテゴリ</option>
                <?php for($i = 1; $i < count($categories); $i++) { ?>
                      <option value="<?= $i ?>" <?= $category_selected[$i];?>><?= $categories[$i] ?></option>
                <?php } ?>
            </select>
            <button name="add_submit" value="1" class="add_submit">夢リストを作る</button>
        </form>
    </div>
</body>
</html>
