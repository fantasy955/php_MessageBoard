<!-- 留言板首页 -->
<?php error_reporting(0); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>留言板首页</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<!-- 登陆界面 -->
	<script src="login.js"></script>
	<div id="login">
		<form action="login.php" method="post">
			<table align="center" >
				<th>
					<td colspan="2">登陆</td>
				</th>
				<tr>
					<td><input type="text" name="name" placeholder="用户名"></td>
					<td><input type="password" name="password" placeholder="密码"></td>
				</tr>
				<tr>
					<td><input type="submit" name="submit" value="确定"	></td>
				</tr>
			</table>
		</form>
		<button class="hbtn" onclick="hide(login)">取消</button>
	</div>
	<div id="alogin">
		<form action="login.php" method="post">
			<table align="center">
				<th>
					<td colspan="2">管理员登陆</td>
				</th>
				<tr>
					<td><input type="text" name="a_name" placeholder="管理员用户名"></td>
					<td><input type="password" name="a_password" placeholder="密码"></td>
				</tr>
				<tr>
					<td><input type="submit" name="a_submit" value="确定"></td>
				</tr>
			</table>	
		</form>
		<button class="hbtn" onclick="hide(alogin)">取消</button>
	</div>
	<table border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse;" align="center" width="400"  height="200">
		<tr>
			<td height="100" style="font-size: 30px;line-height: 30px" align="center"><font face="黑体" >简单留言板</font></td>	
		</tr>
		<tr>
			<script src="index.js"></script>
			<td height="25">&nbsp;<button id="towrite" onclick="demo1()">写留言</button>&nbsp;&nbsp;<button id="tomange" onclick="demo2()">管理留言</button>&nbsp;&nbsp;<button onclick="window.location.href='signin.php'">注册</button>
			</tr>
		</table>
	</body>
	</html>