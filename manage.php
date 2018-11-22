<?php 
error_reporting(0);
session_start();
$name=$_SESSION['user'];
$id=mysqli_connect("localhost","root","9494itsyou");
$flag=mysqli_select_db($id,"gbook");
//判断是否成功连接数据库
if(mysqli_connect_errno($id)) 
{ 
	echo "<script>alert('连接 MySQL 失败:$mysqli_connect_error()');window.location.href='index.php'</script>";
} 
$query="select * from a_user_list where id='$name'";
$result=mysqli_query($id,$query);

//防止普通用户输入链接访问管理员界面 ：http://api.devsense.com/send.php->http://api.devsense.com/manage.php
if(mysqli_num_rows($result)<1){
	echo "<script>alert('错误');window.location.href='index.php'</script>";
	exit();
}
//如果提交了删除请求
if(isset($_GET['delid'])){
	$delid=$_GET['delid'];
	$query="delete from message where id='$delid'";
	mysqli_query($id,$query);
	echo "<script>alert('删除成功！单击确定继续。id:$delid');window.location.href='manage.php'</script>";
}
//如果提交了回复请求
if(isset($_POST['text']))
{
	$replyid=$_GET['replyid'];
	$text=$_POST['text'];
	$query="update message set reply='$text' where id='$replyid'";
	$result=mysqli_query($id,$query);
	echo "<script> alert('回复成功！单击确定继续。id:$replyid');location.href='manage.php'</script>";
}
mysqli_close($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>管理员页面</title>
	<link rel="stylesheet" href="index.css">
</head>
<body>
	<?php		
	session_start();
	echo "<script src='index.js'></script>";
// echo $_SESSION['user'];
	$name=$_SESSION['user'];
	echo "<a href='index.php'>返回首页</a>";
	echo "<table align='center'><tr><th align='center'>管理员 $name</th></tr></table>";
	$id=mysqli_connect("localhost","root","9494itsyou");
	mysqli_select_db($id,"gbook");
	$query="select * from message";
	$result=mysqli_query($id,$query);
	if(mysqli_num_rows($result)<1){
		echo "<p align='center'>目前没有任何留言</p>";
	}
	else{
		$totalnum=mysqli_num_rows($result);
		//每页最多显示留言数目
		$pagesize=10;
		//获取当前页数，如果没有则为1
		$page=isset($_GET['page'])?$_GET['page']:1;
		// $begin 从数据库开始读取的位置
		$begin=($page-1)*$pagesize;
		//总页数
		$totalpage=ceil($totalnum/$pagesize);
		//从开始位置往后读取10条信息
		$query="select * from message order by addtime limit $begin,$pagesize";
		$result=mysqli_query($id,$query);
		$datanum=mysqli_num_rows($result);
		//前一页页数
		$pagepre=$page-1;
		//后一页页数
		$pagenext=$page+1;
		echo "<table border=0 width=95%><tr><td>";
		echo "共有留言 $totalnum 条。";
		echo "每页上限 $pagesize 条，共 $totalpage 页。<br></tr></td></table>";
		//若果当前页数不是1，提供选择上一页的链接
		if($page>1){
			//点击上一页后通过链接地址将page的信息传到manage.php中
			echo "<a href='manage.php?page=$pagepre'>上一页</a>&nbsp";
		}
		//若果当前页数小于最大的页数，提供选择下一页的链接
		if($page<$totalpage){
			echo "<a href='manage.php?page=$pagenext'>下一页</a>";
		}
		echo "&nbsp当前第 $page 页";
		echo "<br>";
		for($i=1;$i<=$datanum;$i++){
			$info=mysqli_fetch_array($result,MYSQLI_ASSOC);
			$id=$info['id'];
			echo $info['username'],"于",$info['addtime']," 留言:",$info['content'],"<br>";
			if($info["reply"]!=""){
				echo "管理员回复:",$info['reply'],"<br>";
			}
			else echo "&nbsp<button onclick=\"window.location.href='reply.php?replyid=$id'\">回复留言</button>";
			echo "&nbsp<button onclick='delMessage($id)'>删除留言</button>";
			echo "<hr>";
		}
	}		
	mysqli_close($id);
	?>
</body>
</html>