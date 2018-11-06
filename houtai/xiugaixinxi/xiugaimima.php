
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
	$mima1=$_POST['xiugaimima1'];
	$mima2=$_POST['xiugaimima2'];
	if($mima1==$mima2)
		$pass=md5($mima1);
	else{
			echo '<script>alert("两次密码不一致!修改失败");window.location.href="/myweb/pcenter.php"</script>';
			exit;
		}	
	$sql = "update user set password ='$pass' where email='$email'";
	mysqli_query($coon, $sql);
	echo "<script>alert('修改成功');window.location.href='/myweb/pcenter.php'</script>";					
?>