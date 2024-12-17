<?php
	session_start();
	include("database.php");
	$did=$_GET['delid'];
	if(isset($_GET['page']))
	{
		$page=$_GET['page'];
	}
	else
	{
		$page='a';
	}
	$result = mysqli_query($link,"delete from result where id='$did'");
	if($page=='g')
	{
		$_SESSION['status'] = "Deleted Successfully";
		header("location:gameresult.php");
	}
	else
	{
		$_SESSION['status'] = "Deleted Successfully";
		header("location:subcategory.php");
	}
	exit;
?>