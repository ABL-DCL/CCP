
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
</html>

<?php
	$coon = mysqli_connect("localhost", "root","yuan");
	mysqli_select_db($coon, "web");
	mysqli_set_charset($coon, "utf8");
	session_start();
	$email = $_SESSION["user"];
	$renwuid = $_GET["renwuid"];
	$suoshuzuoyeid = $_GET["zuoyeid"];
	$plneirong=$_POST['plneirong'];
	$tijiaoshijian = date("Y-m-d H:i:s",time());
	$sql = "insert into pinglun(email,neirong,tijiaoshijian,suoshuzuoyeid) values('$email','$plneirong','$tijiaoshijian','$suoshuzuoyeid')";
	if(!(mysqli_query($coon, $sql))) 
		echo "<script>alert('评论失败');</script>";
	else
		echo "<script>alert('评论成功');window.location.href='/myweb/renwuGUI.php?id=$renwuid'</script>";
						
?>