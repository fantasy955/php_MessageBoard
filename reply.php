<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>回复</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<div id='reply_div'>
		<b>输入回复:<br></b>
		<form action="manage.php?replyid=<?php echo $_GET['replyid'] ?>" method="post">
			<textarea placeholder="最大输入666字" maxlength="700" rows="20" cols="80" style="resize: none" name="text"></textarea>
			<input type="submit" name="submit" value="提交">
		</form>
		<button class='hbtn1' onclick="window.location.href='manage.php'">取消</button>
	</div>
</body>
</html>