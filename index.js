// 显示普通用户登陆界面
function demo1(){
	login=document.getElementById('login');
	login.style.display="block";
}

// 显示管理员登陆界面
function demo2(){
	alogin=document.getElementById('alogin');
	alogin.style.display="block";
}
// 根据id隐藏某个div
function hide(id){
	id.style.display="none";
}
//显示添加留言的界面
function addmessage(){
	div=document.getElementById('message_div');
	div.style.display="block";
}

// function show(id){
// 	id.style.display="block";
// }
function delMessage(id){
	if(confirm('确认删除?')) window.location.href="manage.php?delid="+id+"";
	else window.location.href="manage.php";
} 
//显示管理员回复界面
function reply(id)
{
	div=document.getElementById('reply_div');
	div.style.display="block";
}