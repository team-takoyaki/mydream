<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>My Dream, Your Dream</title>
    <link rel="stylesheet" type="text/css" href="css/add.css">
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
	<form method="POST" class="add_form">
            <div class="item"><input type="text" name="title" placeholder="タイトル" class="title"></div>
            <div class="item"><textarea name="body" placeholder="本文" class="body"></textarea></div>
            <div class="item">
		<select name="category_id" class="category">
                    <option value="">カテゴリ</option>
		    <?php for($i = 1; $i < count($categories); $i++) { ?>
                    <option value="<?= $i ?>"><?= $categories[$i] ?></option>
		    <?php } ?>
		</select>
            </div>
            <button class="submit">夢を書き込む</button>
	</form>
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
