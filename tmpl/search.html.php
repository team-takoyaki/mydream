<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ぼくの夢リスト</title>
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
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
        <div class="dreams_message">
            <h3>カテゴリーで検索</h3>
        </div>
        <form method="GET" class="search_form">
            <select name="category_id" class="category">
            <?php for($i = 1; $i < count($categories); $i++) { ?>
                <option value="<?= $i ?>" <?= $category_selected[$i];?>><?= $categories[$i] ?></option>
            <?php } ?>
            </select>
            <button class="search_submit">検索</button>
        </form>
        <?php if (count($dreams['data']) > 0) { ?>
        <ul class="dreams">
            <?php foreach($dreams['data'] as $dream) {?>
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
        <?php if ($next_flag === true || $prev_flag === true) { ?>
        <div class="paging">
            <?php if ($prev_flag === true) { ?>
            <a href="<?= BASE_URL . '/search.php?category_id=' . $category_id . '&page=' . ($page - 1) ?>">
                <div class="prev_btn paging_btn">前へ</div>
            </a>
            <?php } ?>
            <?php if ($next_flag === true) { ?>
            <a href="<?= BASE_URL . '/search.php?category_id=' . $category_id . '&page=' . ($page + 1) ?>">
                <div class="next_btn paging_btn">次へ</div>
            </a>
            <?php } ?>
            <div class="clear"></div>
        </div>
        <?php } ?>
        <?php } else { ?>
        <div class="careful">夢リストが見つかりませんでした</div>
        <?php } ?>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/search.js"></script>
</body>
</html>
