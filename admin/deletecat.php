<?php
	
	include("database.php");
	$did=$_GET['delid'];
	$result = mysqli_query($link,"select gamename from game where id='$did'");
	$row = $result->fetch_assoc();
	$gm = $row['gamename'];
	$result = mysqli_query($link,"delete from game where id='$did'");
	$result = mysqli_query($link,"delete from result where gamename='$gm'");
//	echo "ID::".$did;
//	echo "<br> Game::".$gm; 
	header("location:categories.php");
	exit;
?>