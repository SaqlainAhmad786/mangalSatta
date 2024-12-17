<?php
session_start();
$aname = $_SESSION['gadminname'];
$aemail = $_SESSION['gadminemail'];
$game = $_SESSION['game'];
if(empty($aname))
{
	// if user is not login
	//header("location:index2.php");
	echo "<script>window.location.href='index2.php'</script>";    
}
else
{
	$pageaccess = true;
}

?>
<?php

include("database.php");
	$result = mysqli_query($link,"SELECT * FROM result WHERE gamename='$game' ORDER BY id DESC LIMIT 1");
	$arr = mysqli_fetch_assoc($result);
	$date = $arr['dt'];	
	$curr_date = date("Y-m-d");
//	echo "Todays Date:".$curr_date."<br>Last Update Date".$date; 
	if($curr_date == $date)
	{
		$update = TRUE;
	}
	else
	{
		$update = FALSE;
	}
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
			 echo "<script>window.location.href='gdashboard.php'</script>";    
		//	header("location:gdashboard.php");
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
											<a href="../index.php" class="nav-link">
												<i class="nav-icon fas fa-home"></i>
												<p>Website</p>
											</a>																
										</li>	
										<li class="nav-item">
											<a href="gdashboard.php" class="nav-link">
												<i class="nav-icon fas fa-tachometer-alt"></i>
												<p>Dashboard</p>
											</a>																
										</li>	
										<li class="nav-item">
											<a href="gameresult.php?update=<?=$update?>" class="nav-link">
												<i class="nav-icon fas fa-file-alt"></i>
												<p>Today's Result</p>
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
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Dashboard Results</h1>
							</div>
							<div class="col-sm-6">
            					<div class="container-fluid">
            						<div class="card">
            							<div class="card-body">					
										<?php
            							if(!empty($_SESSION['status']))
            							{   
            							?>    <span class="label info"><?=$_SESSION['status']?></span>
            							<?php
											unset($_SESSION['status']);
            							}
            							?>
            								<div class="row">
            									<div class="col-md-6">
            										<div class="mb-3">
            											<label for="name">Today's Result.</label>
														<?php
														if($update)
														{
														?>
															<input type="text" name="result" id="result" value ="UPDATED" class="form-control" style="background-color:LightBlue; font-size:18px; color:GREEN" disabled>	
														<?php
														}
														else
														{
														?>
														<input type="text" name="result" id="result" value ="NOT UPDATED" class="form-control" style="background-color:yellow; font-size:18px; color:RED" disabled>	
														<?php
														}
														?>
													</div>
            									</div>								
            								</div>
            							</div>							
            						</div>
            					</div>
                            </div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
	
  
      				<div class="container-fluid">
						<div class="row">
							<div class="col-lg-4 col-6">							
								<div class="small-box card">
									<div class="inner">
										<h3><?=$game?></h3>
										<p>Game Name</p></p>
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
										<h3><?=str_pad($arr['result'], 2, '0', STR_PAD_LEFT)?></h3>
										<p>Last Entered Result (
											<?php
												$parts = explode('-', $date);
												echo $parts[2]."/".$parts[1]."/".$parts[0];
											?>)
										</p>
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
	
	
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	
	
	
	
	
</html>