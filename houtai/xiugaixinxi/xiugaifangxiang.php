
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
	$fangxiang=$_POST['xiugaifangxiang'];
	if(isset($fangxiang))
	{
		$sql = "update user set fangxiang ='$fangxiang' where email='$email'";
		mysqli_query($coon, $sql);
		echo "<script>alert('修改成功');window.location.href='/myweb/pcenter.php'</script>";
	}				
?>