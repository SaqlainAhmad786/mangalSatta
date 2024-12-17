<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$aname = $_SESSION['gadminname'];
$aemail = $_SESSION['gadminemail'];
$game = $_SESSION['game'];
$curr_date = date("Y-m-d");

if(empty($aname))
{
	// if user is not login
    echo "<script>window.location.href='index2.php'</script>";    
//	header("location:index2.php");
}
else
{
	$pageaccess = true;
}

?>


<?php

include("database.php");

extract($_POST);
if(isset($addresult))
{   $result_error = "";
	$result_valid = false;
	if(!empty($result))
	{	
		if(($result>=0)&&($result<100))
		{
			$result_valid = true;
		}
	}
	else
	{
		$result_error = "Enter valid Result";
	}
    if($result_valid==true)
    {
        $sql = "INSERT INTO result (gamename,result,dt) VALUES ('$game','$result','$curr_date')";
        if (mysqli_query($link, $sql))
        {   
        /*  echo "New record created successfully"; */
            $_SESSION['status'] = "Result Added Successfully";
		//	header("location:gameresult.php");
			echo "<script>window.location.href='gameresult.php'</script>";    
			exit;
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>GALI2 :: Administrative Panel</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="css/adminlte.min.css">
		<link rel="stylesheet" href="css/custom.css">
	</head>
	<body class="hold-transition sidebar-mini">
		<!-- Site wrapper -->
		<div class="wrapper">

			<!-- Navbar -->
						<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				<!-- Right navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
					  	<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
					</li>					
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item">
						<a class="nav-link" data-widget="fullscreen" href="#" role="button">
							<i class="fas fa-expand-arrows-alt"></i>
						</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
							<img src="img/avatar5.png" class='img-circle elevation-2' width="40" height="40" alt="">
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
							<h4 class="h4 mb-0"><strong><?=$aname?></strong></h4>
							<div class="mb-3"><?=$aemail?></div>
							<div class="dropdown-divider"></div>
							<div class="dropdown-divider"></div>
							<a href="gadmin-changepassword.php" class="dropdown-item">
								<i class="fas fa-lock mr-2"></i> Change Password
							</a>
							<div class="dropdown-divider"></div>
							<a href="logout.php?page=2" class="dropdown-item text-danger">
								<i class="fas fa-sign-out-alt mr-2"></i> Logout							
							</a>							
						</div>
					</li>
				</ul>
			</nav>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
	
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<!-- Brand Logo -->
				<a href="gdashboard.php" class="brand-link">
					<img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
					<span class="brand-text font-weight-light">Satta King</span>
				</a>
				<!-- Sidebar -->
				<div class="sidebar">
					<!-- Sidebar user (optional) -->
										<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
							<li class="nav-item">
								<a href="gdashboard.php" class="nav-link">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>																
							</li>
							<li class="nav-item">
								<a href="gameresult.php" class="nav-link">
									<i class="nav-icon fas fa-file-alt"></i>
									<p>Today's Results</p>
								</a>
							</li>
						</ul>
					</nav>
					<!-- /.sidebar-menu -->
				</div>
				<!-- /.sidebar -->
			</aside>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Enter Today's Result</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="gameresult.php" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<form  method="post">
					<div class="container-fluid">
						<div class="card">
							<div class="card-body">								
								<div class="row">
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="name">Result</label>
											<input type="number" name="result" id="result" class="form-control" required placeholder="Result">	
										</div>
									</div>
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<input type="Submit" name="addresult" class="btn btn-primary" Value="Submit">
							<a href="gameresult.php" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
					</form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			</div>
			<!-- /.content-wrapper -->
			<?php
				include("footer.php");
			?>
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="js/adminlte.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="js/demo.js"></script>
	</body>
</html>