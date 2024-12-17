<?php

include("database.php");

session_start();
$loginemail = $_SESSION['adminemail'];

if(!empty($_GET['opdata']) && !empty($_GET['npdata']))
{
	$opdata = $_GET['opdata'];
	$npdata = $_GET['npdata'];
	
	
	$result = mysqli_query($link,"select * from admin where email='$loginemail'");
	$arr = mysqli_fetch_assoc($result);
	
		
	if(md5($opdata) == $arr['password'])
	{
		$npdata = md5($npdata);
		mysqli_query($link,"update admin set password='$npdata' where email='$loginemail'");
		echo '<script>alert("Password Changed")</script>';
		session_destroy();
		exit;
		//header("location:logout.php");
	}
	else
	{
		echo "Old Password Incorrect";
	}
	
	
}

?>