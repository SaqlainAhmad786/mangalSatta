<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$aname = $_SESSION['gadminname'];
$aemail = $_SESSION['gadminemail'];
$game = $_SESSION['game'];
if(isset($_GET['update']))
{
	$update = $_GET['update'];
}
else
{
	$update = TRUE;
}
//echo "Aname::".$aname;
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
$curr_date = date("Y-m-d");

?>

<?php
	include("database.php");
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
		<style>
			li {
				margin-left: 20px; 
			}
		</style>
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
											<a href="gameresult.php?update=<?=$update?>" class="nav-link">
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
								<h1>Results</h1>
							</div>
							<div class="col-sm-6 text-right">
							<?php
							if(!$update)
							{
							?>
								<a href="create-gameresult.php" class="btn btn-primary">Enter New Result</a>
							<?php
							}
							?>
							</div>
							<?php
            					if(!empty($_SESSION['status']))
            					{   
            				?>    
									<span class="label info"><?=$_SESSION['status']?></span>
            				<?php
									unset($_SESSION['status']);
            					}
            				?>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				
				<section class="content">
					<!-- Default box -->
				<div class="container-fluid">
						<div class="card">
							<div class="card-header">
								<div class="card-tools">
									<div class="input-group input-group" style="width: 250px;">
										<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
					
										<div class="input-group-append">
										  <button type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										  </button>
										</div>
									  </div>
								</div>
							</div>
							<div class="card-body table-responsive p-0">								
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">S.No.</th>
											<th>Game Name</th>
											<th>Date</th>
											<th>Result</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<!--Pagination Code Start-->
									<?php
									//	include('db.php');

										if (isset($_GET['page_no']) && $_GET['page_no']!="") {
											$page_no = $_GET['page_no'];
											} else {
												$page_no = 1;
												}

											$total_records_per_page = 30;
											$offset = ($page_no-1) * $total_records_per_page;
											$previous_page = $page_no - 1;
											$next_page = $page_no + 1;
											$adjacents = "2"; 

											$result_count = mysqli_query($link,"SELECT COUNT(*) As total_records FROM `result` WHERE gamename='$game'");
											$total_records = mysqli_fetch_array($result_count);
											$total_records = $total_records['total_records'];
											$total_no_of_pages = ceil($total_records / $total_records_per_page);
											$second_last = $total_no_of_pages - 1; // total page minus 1
										//	echo "Total::".$total_records."<br>Pages:".$total_no_of_pages."<br>2nd Last Page:".$second_last;
									?>
									<!-- Pagination Code Phase 1 End	-->	
									
									<?php
										$ctr = 1;
										$result = mysqli_query($link,"SELECT * FROM `result` WHERE gamename='$game' ORDER BY dt DESC LIMIT $offset, $total_records_per_page");
										while($arr = mysqli_fetch_assoc($result))
										{
											$date = $arr['dt'];	
									?>
										<tr>
											<td><?=$ctr?></td>
											<td><?=$arr['gamename']?></td>
											<td><?=$arr['dt']?></td>
											<td><?=str_pad($arr['result'], 2, '0', STR_PAD_LEFT)?></td>
											<td>
											<?php
												if($curr_date == $date)
												{
													$page = 'g';
											?>
												<a href="deleteresult.php?delid=<?=$arr['id']?>&page=<?=$page?>" class="text-danger w-4 h-4 mr-1">
													<svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
												  	</svg>
												</a>
											<?php
												}
												else
												{
											?>
													<svg class="text-success h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
														<path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
													</svg>
											<?php
												}
											?>
											</td>
										</tr>
									<?php
										$ctr++;
										}
										mysqli_close($link);
									?>
				
									</tbody>
								</table>
							<!--Footer for pagenumber	-->
							<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
							<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
							</div>

							<ul class="pagination">
								<?php // if($page_no > 1){ echo "<li><a href='gameresult.php?page_no=1'>First Page</a></li>"; } ?>
								
								<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
								<a <?php if($page_no > 1){ echo "href='gameresult.php?page_no=$previous_page'"; } ?>>Previous</a>
								</li>
								   
								<?php 
								if ($total_no_of_pages <= 10){  	 
									for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
										if ($counter == $page_no) {
									   echo "<li class='active'><a>$counter</a></li>";	
											}else{
									   echo "<li><a href='gameresult.php?page_no=$counter'>$counter</a></li>";
											}
									}
								}
								elseif($total_no_of_pages > 10){
									
								if($page_no <= 4) {			
								 for ($counter = 1; $counter < 8; $counter++){		 
										if ($counter == $page_no) {
									   echo "<li class='active'><a>$counter</a></li>";	
											}else{
									   echo "<li><a href='gameresult.php?page_no=$counter'>$counter</a></li>";
											}
									}
									echo "<li><a>...</a></li>";
									echo "<li><a href='gameresult.php?page_no=$second_last'>$second_last</a></li>";
									echo "<li><a href='gameresult.php?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
									}

								 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
									echo "<li><a href='gameresult.php?page_no=1'>1</a></li>";
									echo "<li><a href='gameresult.php?page_no=2'>2</a></li>";
									echo "<li><a>...</a></li>";
									for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
									   if ($counter == $page_no) {
									   echo "<li class='active'><a>$counter</a></li>";	
											}else{
									   echo "<li><a href='gameresult.php?page_no=$counter'>$counter</a></li>";
											}                  
								   }
								   echo "<li><a>...</a></li>";
								   echo "<li><a href='gameresult.php?page_no=$second_last'>$second_last</a></li>";
								   echo "<li><a href='gameresult.php?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
										}
									
									else {
									echo "<li><a href='gameresult.php?page_no=1'>1</a></li>";
									echo "<li><a href='gameresult.php?page_no=2'>2</a></li>";
									echo "<li><a>...</a></li>";

									for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
									  if ($counter == $page_no) {
									   echo "<li class='active'><a>$counter</a></li>";	
											}else{
									   echo "<li><a href='gameresult.php?page_no=$counter'>$counter</a></li>";
											}                   
											}
										}
								}
							?>
								
								<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
								<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
								</li>
								<?php if($page_no < $total_no_of_pages){
									echo "<li><a href='gameresult.php?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
									} ?>
							</ul>
							<!--Pagination code End-->

								
							</div>	<!--
							<div class="card-footer clearfix">
								<ul class="pagination pagination m-0 float-right">
								  <li class="page-item"><a class="page-link" href="#">«</a></li>
								  <li class="page-item"><a class="page-link" href="#">1</a></li>
								  <li class="page-item"><a class="page-link" href="#">2</a></li>
								  <li class="page-item"><a class="page-link" href="#">3</a></li>
								  <li class="page-item"><a class="page-link" href="#">»</a></li>
								</ul>
							</div>	-->
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
</html>

<!--SELECT * FROM `result` ORDER BY gamename, dt DESC, tm;	-->