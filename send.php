<?php 
error_reporting(0);
session_start();
$name=$_SESSION['user'];
$id=mysqli_connect("localhost","root","9494itsyou");
mysqli_select_db($id,"gbook");
if(mysqli_connect_errno($id)) 
{ 
	echo "<script>alert('连接 MySQL 失败:$mysqli_connect_error()');window.location.href='index.php'</script>";
} 
$query="select * from user_list where id='$name'";
$result=mysqli_query($id,$query);
if(mysqli_num_rows($result)<1){
	echo "<script>alert('错误');window.location.href='index.php'</script>";
	exit();
}
mysqli_close($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>留言页</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<script src="index.js"></script>
	<div id="message_div">
		<b>输入留言:<br></b>	
		<form action="send.php" method="post"> 
			<textarea placeholder="最大输入666字" maxlength="700" rows="20" cols="80" style="resize: none" name="text"></textarea>
			<input type="submit" name="submit" value="提交">
		</form>
	</div>
	<?php		
	session_start();
// echo $_SESSION['user'];
	$name=$_SESSION['user'];
	echo "我的留言";
	echo "    <a href='index.php'>返回首页</a>";
	echo "<table align='center'><tr><th align='center'>欢迎您 $name</th></tr></table>";
	$id=mysqli_connect("localhost","root","9494itsyou");
	mysqli_select_db($id,"gbook");
	$pagesize=10;
	$page=isset($_GET['page'])?$_GET['page']:1;
	$begin=($page-1)*$pagesize;
	$query="select * from message where username='$name'";
	$result=mysqli_query($id,$query);
	$totalnum=mysqli_num_rows($result);
	$totalpage=ceil($totalnum/$pagesize);
	$result=mysqli_query($id,$query);
	$pagepre=$page-1;
	$pagenext=$page+1;
	if(mysqli_num_rows($result)<1){
		echo "<p align='center'>目前没有任何留言</p>";
	}
	else{
		$query="select * from message where username='$name' order by addtime limit $begin,$pagesize";
		$result=mysqli_query($id,$query);
		$datanum=mysqli_num_rows($result);
		echo "<table border=0 width=95%><tr><td>";
		echo "共有留言 $totalnum 条。";
		echo "每页上限 $pagesize 条，共 $totalpage 页。<br>";
		if($page>1){
			echo "<a href='send.php?page=$pagepre'>上一页</a>&nbsp";
		}
		if($page<$totalpage){
			echo "<a href='send.php?page=$pagenext'>下一页</a>";
		}
		echo "&nbsp当前	第 $page 页";
		echo "<br>";
		for($i=1;$i<=$datanum;$i++){
			$info=mysqli_fetch_array($result,MYSQLI_ASSOC);
			echo "<b><font color = 'red'>",$info['username'],"</font></b>","于",$info['addtime']," 留言:  <b>",$info['content'],"</b>";
			if($info["reply"]!=""){
				echo "<br>管理员回复:",$info['reply'];
			}
			echo "<hr>";
		}
	}
	echo "<button onclick='addmessage()'><span style='color:red'>添加留言</span></button>";
	if(isset($_POST['submit'])){
		$text=$_POST['text'];
		$insert="insert into message(username,content) values('$name','$text')";
		mysqli_query($id,$insert);
		unset($_POST['submit']);
		unset($_POST['text']);
		echo "<script> alert('留言成功！单击确定继续。');location.href='send.php';</script>";
	}
	mysqli_close($id);
	?>
</body>
</html>
