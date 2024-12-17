<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
	}
	if(isset($_SESSION['username'])&&isset($_SESSION['usermobile']))
	{
		$un = $_SESSION['username'];
		$um = $_SESSION['usermobile'];
	}
?>
<?php
define('MyConst', TRUE);
?>

<?php include("header.php")?>

<body>
<?php
define('MyConst', TRUE);
?>
<?php include("nav.php")?>
<div class="text-center">
<h1 style="font-size: 25px; color: #000;"><b>Satta King Online Play | Satta Online Khaiwal | GALI2 Online Khaiwal</b></h1>
</div>
<?php include("include/ads1.php")?>
<?php include("include/ads2.php")?>

<?php include("footer.php")?>