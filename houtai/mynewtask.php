
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>

</html>
<?php
						session_start();
						$coon = mysqli_connect("localhost", "root","yuan");
						mysqli_select_db($coon, "web");
						mysqli_set_charset($coon, "utf8");
						$chuangjianshijian=date("Y-m-d-H-i-s",time());
						$yonghuemail=$_SESSION["user"];
						$neirong=$_POST['neirong'];
						
						//随机文件名
						$old = array_merge(range("a", "z"), range("A", "Z"));
					    shuffle($old);
						$newname = date("YmdHis")+$old[0].$old[1].$old[2].$old[3].$old[4].$old[5].$old[6].$old[7].$old[8].$old[9].$old[10];
					    
				       	
						$count=1;
						while(isset($_POST['zuoye'.$count]))
						{
								${'zuoye'.$count} = $_POST['zuoye'.$count];
								$count++;
						}
						$count--;
						if($count!=0)
						{
							$name = $_FILES['fujian']['name'];
							move_uploaded_file($_FILES['fujian']['tmp_name'], "/home/wwwroot/default/myweb/upfile/{$newname}");
							if($_FILES['fujian']['name']!='')
								$fujian= "/myweb/upfile/{$newname}";
							else
								$fujian='NULL';
							if($_POST['zhuti']!='')
								$zhuti=$_POST['zhuti'];
							else{
								echo '<script>alert("请输入任务主题!");window.location.href="/myweb/newtask.php"</script>';
								exit;
							}
							if($_POST['fangxiang']!='')
								$fangxiang=$_POST['fangxiang'];
							else{
								echo '<script>alert("请输入任务类型!");window.location.href="/myweb/newtask.php"</script>';
								exit;
							}
							if($_POST['jiezhishijian']!='')
								if(strtotime($_POST['jiezhishijian'])>strtotime(date("y-m-d h:i:s")))
								{									
									$jiezhishijian=$_POST['jiezhishijian'];
								}
								else 
								{
									echo '<script>alert("截止时间不能小于创建时间!");window.location.href="/myweb/newtask.php"</script>';
									exit;
								}
							else{
								echo '<script>alert("请输入任务截止时间!");window.location.href="/myweb/newtask.php"</script>';
								exit;
							}
							$sql = "insert into renwu(yonghuemail,zhuti,neirong,fangxiangming,chuangjianshijian,jiezhishijian,fujian,fujianming) 
									values('$yonghuemail','$zhuti','$neirong','$fangxiang','$chuangjianshijian','$jiezhishijian','$fujian','$name')";
							mysqli_query($coon, $sql);
							$sql1 = "select id from renwu where yonghuemail='$yonghuemail' and chuangjianshijian='$chuangjianshijian'";
							$r = mysqli_query($coon, $sql1);
							$row = mysqli_fetch_object($r);
							while($count!=0)
							{
								$sql2 ="insert into zuoye(zuoyeneirong,suoshurenwuid) values('${'zuoye'.$count}','$row->id')";
								mysqli_query($coon, $sql2);
								$count--;
							}	
							$sql3 ="select * from zuoye where suoshurenwuid='$row->id'";		
							if(!(mysqli_query($coon, $sql3))) 
								echo "<script>alert('发布失败!');window.location.href='/myweb/index.php'</script>";
							else
								echo "<script>alert('发布成功！');window.location.href='/myweb/index.php'</script>";
						}
						else
							echo "<script>alert('发布失败，至少要有一个作业!');window.location.href='/myweb/index.php'</script>";
?>