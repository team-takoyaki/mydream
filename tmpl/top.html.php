<!DOCTYPE html>
<header>
    <meta charset="utf-8">
    <title>Doing</title>
    <link rel="stylesheet" type="text/css" href="css/top.css">
</header>
<body>
    <p>
        Hello <?= $users->users['user_name'];?>
    </p>
    <p>
        <a href="<?= $users->users['user_page'];?>" target="_blank">
            <img src="<?= $users->users['user_icon'];?>">
        </a>
    </p>
    <p>写真がリンク</p>
    <p>
        <a href="<?= 'write_dream.php';?>">write dream</a>
    </p>
    <p>
        <a href="logout.php">Logout</a>
    </p>
    <form method="GET">
        <div class="item">
            choice category...
            <select name="category">
                <option value="social" <?php set_selected_category('social', $category);?>>Social</option>
                <option value="politics" <?php set_selected_category('politics', $category);?>>Politics</option>
                <option value="life" <?php set_selected_category('life', $category);?>>Life</option>
                <option value="sports" <?php set_selected_category('sports', $category);?>>Sports</option>
                <option value="music" <?php set_selected_category('music', $category);?>>Music</option>
                <option value="entertainment" <?php set_selected_category('entertainment', $category);?>>Entertainment</option>
                <option value="science" <?php set_selected_category('science', $category);?>>Science</option>
                <option value="it" <?php set_selected_category('it', $category);?>>Computer</option>
                <option value="game" <?php set_selected_category('game', $category);?>>Game</option>
                <option value="anime" <?php set_selected_category('anime', $category);?>>Anime</option>
                <option value="other" <?php set_selected_category('other', $category);?>>Other</option>
            </select>
        </div>
        <button>Submit</button>
    </form>
    <?php if ($is_choice === true) { ?>
        <p>search category...<?= $category;?></p>
        <?php foreach($dreams as $dream) {?>
            <dl>
                <dt><a href="<?= BASE_URL . '/dream.php?id=' . $dream['id'];?>"><?= $dream['title'];?></a></dt>
                <dd><?= $dream['body'];?></dd>
            </dl>
        <?php }?>
        <?php if (count($dreams) === 0) {?>
            <p>Nothing dream ...</p>
        <?php }?>
    <?php } else {?>
        <p>search dream category</p>
    <?php }?>
    <h2>Users</h2>
    <?php if (count($users) > 0) { ?>
       <ul>
       <?php foreach ($user_list as $user) { ?>
           <?php if ($user['id'] !== intval($users->users['dr_user_id'])) { ?>
               <li><a href="<?= USER_PHP ?>?user_id=<?= $user['id']; ?>"><?= $user['user_name'] ?></a></li>
           <?php } ?>
       <?php } ?>
       </ul>
    <?php } ?>
    <script type="text/javascript" src="scripts/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="scripts/geolocation.js"></script>
    <script type="text/javascript" src="scripts/top.js"></script>
</body>
</html>
