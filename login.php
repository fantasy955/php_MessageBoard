<?php
echo "1";
error_reporting(0);
if(isset($_POST['submit'])){
	echo "2";
	$name=$_POST['name'];
	$password=$_POST['password'];
	echo "3$name";
	if($name!=""){
		echo "4";
		echo "9";
		$id=mysqli_connect('localhost','root','9494itsyou');
		echo "8";
		mysqli_select_db($id,'gbook');
		echo "7";
		if(mysqli_connect_errno($id)) 
		{ 
			echo "6";
			echo "<script>alert('连接 MySQL 失败:$mysqli_connect_error()');window.location.href='index.php'</script>";
		} 
		echo "5";
		$query="select * from user_list where id='$name'";
		$result=mysqli_query($id,$query);
		$flag=mysqli_num_rows($result);
		if($flag){
			echo "5";
			$info=mysqli_fetch_array($result,MYSQLI_ASSOC);
			if($password==$info['password']){
				//echo "4";
				session_start();
				$_SESSION['login']='YES';
				$_SESSION['user']=$name;
				echo "<script>alert('登陆成功');window.location.href='send.php'</script>";
			}
			else echo "<script>alert('密码错误');window.location.href='index.php'</script>";
		}
		else echo "<script>alert('用户不存在');window.location.href='index.php'</script>";
	}
	else echo "<script>alert('用户名为空');window.location.href='index.php'</script>";
}


else{
	$name=$_POST['a_name'];
	$password=$_POST['a_password'];
	if($name!=""){
		$id=mysqli_connect('localhost','root','9494itsyou');
		mysqli_select_db($id,'gbook');
		if(mysqli_connect_errno($id)) 
		{ 
			echo "<script>alert('连接 MySQL 失败:$mysqli_connect_error()');window.location.href='index.php'</script>";
		} 
		$query="select * from a_user_list where id='$name'";
		$result=mysqli_query($id,$query);
		$flag=mysqli_num_rows($result);
		if($flag){
			$info=mysqli_fetch_array($result,MYSQLI_ASSOC);
			if($password==$info['password']){
				session_start();
				$_SESSION['login']='YES';
				$_SESSION['user']=$name;
				echo "<script>alert('登陆成功');window.location.href='manage.php'</script>";
			}
			else echo "<script>alert('密码错误');window.location.href='index.php'</script>";
		}
		else echo "<script>alert('用户不存在');window.location.href='index.php'</script>";
	}
	else echo"<script>alert('用户名为空');window.location.href='index.php'</script>";
}
mysqli_close($id);