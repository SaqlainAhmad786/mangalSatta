<?php
	include("database.php");
	$did=$_GET['delid'];
	$result = mysqli_query($link,"delete from gameadmin where id='$did'");
	header("location:gameadmin.php");
	exit;
?>