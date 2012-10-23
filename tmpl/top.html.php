<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Doing</title>
    <link rel="stylesheet" type="text/css" href="css/top.css">
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
        <?php if (count($user_dreams) > 0) { ?>
            <?php foreach($user_dreams as $dream) {?>
            <ul class="user_dreams">
		<li class="dream">
		    <a href="<?= BASE_URL . '/dream.php?id=' . $dream['id'];?>"><?= $dream['title'];?></a>
		</li>
	    </ul>
            <?php }?>
        <?php } else { ?>
	    <a href="<?= 'write_dream.php';?>"><p class="dream_message">あなたの夢を書きましょう</p></a>
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
