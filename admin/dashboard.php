<?php
session_start();
$aname = $_SESSION['adminname'];
$aemail = $_SESSION['adminemail'];

if(empty($aname))
{
	// if user is not login
	header("location:index.php");
}
else
{
	$pageaccess = true;
}

?>
<?php

include("database.php");
extract($_POST);
if(isset($addgame))
{   $game_error = "";
	$gamename = trim($gamename);
	$s = "delete from current";
	if (mysqli_query($link, $s))
    {

        $sql = "INSERT INTO current (gname,number) VALUES ('$gamename','$tm')";
        if (mysqli_query($link, $sql))
        {   
            $_SESSION['status'] = "Category Added Successfully";
			header("location:dashboard.php");
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
		<title>Dashboard :: Administrative Panel</title>
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
			<?php
				include("nav1.php");
			?>
			<!-- /.navbar -->
			<!-- Main Sidebar Container -->
			
			<?php
				include("mainsidebar.php");
			?>
			
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">					
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Dashboard Live Results</h1>
							</div>
							<div class="col-sm-6">
            				<form  method="post">
            					<div class="container-fluid">
            						<div class="card">
            							<div class="card-body">					<?php
            							if(!empty($_SESSION['status']))
            							{   
            							?>    <span class="label info"><?=$_SESSION['status']?></span>
            							<?php
            							}
            							?>
            								<div class="row">
            									<div class="col-md-6">
            										<div class="mb-3">
            											<label for="name">Live Game Name</label>
            											<input type="text" name="gamename" id="gamename" class="form-control" placeholder="Game Name">	
            										</div>
            									</div>								
            								</div>
            								<div class="row">
            									<div class="col-md-6">
            										<div class="mb-3">
            											<label for="name">Live Today Number.</label>
            											<input type="text" name="tm" id="tm" class="form-control" placeholder="Number">	
            										</div>
            									</div>								
            								</div>
            							</div>							
            						</div>
            						<div class="pb-5 pt-3">
            							<input type="Submit" name="addgame" class="btn btn-primary" Value="Submit">
            							
            						</div>
            					</div>
                                </form>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
	
<?php
    $r_cur = mysqli_query($link,"select * from current");
    while ($ar_cur = mysqli_fetch_assoc($r_cur))
    {
?>    
      				<div class="container-fluid">
						<div class="row">
							<div class="col-lg-4 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3><?=$ar_cur['gname']?></h3>
										<p>Live Current Game Name</p></p>
									</div>
									<div class="icon">
										<i class="ion ion-bag"></i>
									</div>  <!--
									<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a> -->
								</div>
							</div>
							
							<div class="col-lg-4 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3><?=$ar_cur['number']?></h3>
										<p>Live Current Number</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>  <!--
									<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a> -->
								</div>
							</div>
							
	<!--						<div class="col-lg-4 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3>$1000</h3>
										<p>Total Sale</p>
									</div>
									<div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
								</div>
							</div>      -->
						</div>
					</div>
<?php
    }
?>
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