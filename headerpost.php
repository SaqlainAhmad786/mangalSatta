<?php
if(!defined('MyConst')) {
   die('Direct access not permitted');
}
?>
<?php 
    include("admin/database.php");
	$sql1 = "select distinct year(dt) as year from result order by dt";
	$r_year = mysqli_query($link, $sql1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>GALI2</title>
    <meta name="revisit-after" content="everyday" />
    <meta name="googlebot" content="index, follow">
    <meta name="robots" content="index, follow" />
    <!-- Favicon Icon -->
    <link rel="icon" href="images/swastik.png" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">
    <!-- Owl Stylesheets -->
   
    <meta name="google-site-verification" content="WwY_mW07KOCHVCvxCEX3ju_M4BkcBvjYu04Y0hd0kYM" />
    <meta name="msvalidate.01" content="E6A2A2C6EA87936D7748777668472FE3" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
</head>
