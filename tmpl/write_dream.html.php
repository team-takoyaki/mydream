<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>My Dream, Your Dream</title>
    <link rel="stylesheet" type="text/css" href="css/write_dream.css">
</head>
<body>
   <h1>Let's write your dream</h1>
   <form method="POST">
   <div class="item"><input type="text" name="title" placeholder="title"></div>
   <div class="item"><textarea name="body" placeholder="body"></textarea></div>
   <div class="item">
       <select name="category">
	   <option value="">Category</option>
	   <option value="social">Social</option>
	   <option value="politics">Politics</option>
	   <option value="life">Life</option>
	   <option value="sports">Sports</option>
	   <option value="music">Music</option>
	   <option value="entertainment">Entertainment</option>
	   <option value="science">Science</option>
	   <option value="it">Computer</option>
	   <option value="game">Game</option>
	   <option value="anime">Anime</option>
	   <option value="other">Other</option>
       </select>
   </div>
   <button>Submit</button>
   </form>
</body>
</html>
