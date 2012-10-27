<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title><?= $dream['title']; ?></title>
        <link rel="stylesheet" type="text/css" href="css/dream.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    </head>
    <body>
        <div id="body">
            <nav>
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
            <header>
                <div class="title">
                    <div class="vertical_middle">
                        <h1><?= htmlspecialchars($dream['title']); ?></h1>
                    </div>
		        </div>
		        <div class="dream_info">
                    <form method="POST" class="cheers_btn_form">
			            <?php if ($cheer_users > 0) { ?>
			            <?php } ?>
			            <?php if ($cheer_flg === true) { ?>
			            <button name="cheers" class="cheers_btn" value="cheers">がんばれ</button>
			            <?php } else { ?>
			            <button name="cheers" class="cheers_btn" value="cheers" disabled>応援中</button>
			            <?php } ?>
                    </form>		  
		            <?php if ($cheer_users > 0) { ?>
		            <div class="cheers_message">
			            <?= $cheer_users ?>人が応援しています
		            </div>
		            <?php } ?>
		            <div class="order_save">
			            <button class="order_edit_btn" name="order_edit">編集する</button>
			            <button class="order_save_btn display_none" name="order_save">保存</button>
		            </div>  
		        </div>
            </header>
            <div class="dream_wrapper">
                <div class="dream">
		            <ul class="sortable">
                        <?php foreach ($comments as $comment) { ?>
		                <li class="ui-state-default" data-comment-id="<?= $comment['id'] ?>">
                            <div class="comment">
                                <p class="comment_body"><?= set_html_from_text($comment['body']); ?></p>
			                    <div class="tool display_none">
			                        <div class="edit_btn">編集する</div>
                                    <form method="POST" class="thanks_btn_form">
				                        <?php if ($is_thank[$comment['id']] === true) { ?>
				                        <button name="comment_id" class="thanks_btn" value="<?= $comment['id']; ?>">メモる</button>
				                        <?php } else { ?>
				                        <button name="comment_id" class="thanks_btn" value="<?= $comment['id']; ?>" disabled>メモってます</button>
				                        <?php } ?>
                                    </form>
			                    </div>
                            </div>
		                </li>
                        <?php } ?>
		            </ul>
                    <form method="POST" class="comment_form">
                        <textarea name="user_comment" class="user_comment"></textarea>
                        <button name="post" class="submit">投稿</button>
                    </form>
                </div>
            </div>
	    </div>
	    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.js"></script>
	    <script src="js/dream.js"></script>
    </body>
</html>
