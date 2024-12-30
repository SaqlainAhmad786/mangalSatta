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
<?php include("nav.php")?>
<!-- <div class="text-center p-2 m-2" style="background: #fff; border-radius: 8px; border: solid 1px #2097D8;">
    <h1 class="" style="font-size: 25px; color: #2097D8;"><b>Black <span style="color: #2097D8;">Satta King Chart</span></b></h1>
    <p style="color: #0B5180;">GALI2 Result, Black Satta King Chart For Gali Desawar and Faridabad Ghaziabad, Mangal Murti, Delhi Bazar, Shree Ganesh, Satta King at GALI2.com</p>
    
</div> -->

<?php include("search.php")?>
<?php include("monthreport.php")?>
<?php include("footer.php")?>