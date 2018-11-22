<?php
error_reporting(0);
if(isset($_POST['submit']))
{
	$name=$_POST['name'];
	$p1=$_POST['password1'];
	$p2=$_POST['password2'];
	echo "$p1,$p2";
	if($p1!=$p2){
		unset($_POST['submit']);
		echo "<script>alert('两次密码输入不一致!');window.location.href='signin.php'</script>";
	} 
	if($p1==""){
		unset($_POST['submit']);
		echo "<script>alert('密码不能为空!');window.location.href='signin.php'</script>";
	}
	if($name==""){
		unset($_POST['submit']);
		echo "<script>alert('用户名不能为空!');window.location.href='signin.php'</script>";
	}
	if($p1==$p2 && $p1!="" && $name!=""){
		$id=mysqli_connect("localhost","root","9494itsyou");
		mysqli_select_db($id,"gbook");
		if(mysqli_connect_errno($id)) 
		{ 
			echo "<script>alert('连接 MySQL 失败:$mysqli_connect_error()');window.location.href='index.php'</script>";
		} 
		$query="select * from user_list where id='$name'";
		$result=mysqli_query($id,$query);
		//判断用户名是否重复
		if(mysqli_num_rows($result)<1){
			$query="insert into user_list(id,password) values('$name','$p1')";
			mysqli_query($id,$query);
			echo "<script>alert('注册成功!');window.location.href='index.php'</script>";
		}
		else echo "<script>alert('用户名重复!');window.location.href='signin.php'</script>";
		mysqli_close($id);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
</head>
<body>
	<form action="signin.php" method="post">
		<table align="center" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
			<tr><th>注册页面</th></tr>
			<tr align="center">
				<!-- 限制用户名为英文，数字，下划线 -->
				<td><input onkeyup="value=value.replace(/[\W]/g,'')"  
					onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" type="text" name="name" placeholder="请输入用户名" maxlength="10"></td>
				</tr>
				<tr align="center">
					<td><input type="password" name="password1" placeholder="请输入密码" maxlength="20"></td>
				</tr>
				<tr align="center">
					<td><input type="password" name="password2" placeholder="请再次输入密码" maxlength="20"></td>
				</tr>
				<tr align="center">
					<td><input type="submit" name="submit" value="确定" style="border: 0"></td>
				</tr>
			</table>
		</form>
	</body>
	</html>