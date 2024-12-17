<?php
session_start();
$aname = $_SESSION['adminname'];
$aemail = $_SESSION['adminemail'];
if(empty($aname))
{
	// if gameadmin is not login
	echo "<script>window.location.href='index.php'</script>";

//	header("location:index.php");
}
else
{
	$pageaccess = true;
}
include("database.php");
if (isset($_GET['gaid']))
{
    $gaid = $_GET['gaid'];
    mysqli_query($link,"UPDATE gameadmin SET approve = 1 WHERE id = $gaid");
    echo "<script>window.location.href='gameadmin.php'</script>";
    //header("location:gameadmin.php");
}
if (isset($_GET['gaidr']))
{
    $gaid = $_GET['gaidr'];
    mysqli_query($link,"UPDATE gameadmin SET approve = 0 WHERE id = $gaid");
    echo "<script>window.location.href='gameadmin.php'</script>";
//    header("location:gameadmin.php");
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Game Admin</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="create-gameadmin.php" class="btn btn-primary">Create New Game Admin</a>
							</div>
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
											<th>Game Admin Name</th>
											<th>Email</th>
											<th>Game Name</th>
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

											$result_count = mysqli_query($link,"SELECT COUNT(*) As total_records FROM `gameadmin`");
											$total_records = mysqli_fetch_array($result_count);
											$total_records = $total_records['total_records'];
											$total_no_of_pages = ceil($total_records / $total_records_per_page);
											$second_last = $total_no_of_pages - 1; // total page minus 1
									?>
									<!-- Pagination Code Phase 1 End	-->	
									
									<?php
										$ctr = 1;
										$result = mysqli_query($link,"SELECT gameadmin.id, gameadmin.name, gameadmin.email, gameadmin.game, game.gamename, gameadmin.approve 
										FROM gameadmin,game WHERE gameadmin.game=game.id ORDER BY name DESC, game ASC LIMIT $offset, $total_records_per_page");
										while($arr = mysqli_fetch_assoc($result))
										{
									?>
										<tr>
											<td><?=$ctr?></td>
											<td><?=$arr['name']?></td>
											<td><?=$arr['email']?></td>
											<td><?=$arr['gamename']?></td>
											<td><a href="deletegameadmin.php?delid=<?=$arr['id']?>" class="text-danger w-4 h-4 mr-1">
													<svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
												  	</svg>
												</a>
											<?php
											    if($arr['approve']==0){
											?>
												<a href="gameadmin.php?gaid=<?=$arr['id']?>">
												    <img src="img/check.png" width="15" height="15">
												</a>
											<?php
											    }
											    else{
											?>  
											    <a href="gameadmin.php?gaidr=<?=$arr['id']?>">
											        <img src="img/cross.png" width="15" height="15">
											    </a>
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
								<?php // if($page_no > 1){ echo "<li><a href='gameadmin.php?page_no=1'>First Page</a></li>"; } ?>
								
								<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
								<a <?php if($page_no > 1){ echo "href='gameadmin.php?page_no=$previous_page'"; } ?>>Previous</a>
								</li>
								   
								<?php 
								if ($total_no_of_pages <= 10){  	 
									for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
										if ($counter == $page_no) {
									   echo "<li class='active'><a>$counter</a></li>";	
											}else{
									   echo "<li><a href='gameadmin.php?page_no=$counter'>$counter</a></li>";
											}
									}
								}
								elseif($total_no_of_pages > 10){
									
								if($page_no <= 4) {			
								 for ($counter = 1; $counter < 8; $counter++){		 
										if ($counter == $page_no) {
									   echo "<li class='active'><a>$counter</a></li>";	
											}else{
									   echo "<li><a href='gameadmin.php?page_no=$counter'>$counter</a></li>";
											}
									}
									echo "<li><a>...</a></li>";
									echo "<li><a href='gameadmin.php?page_no=$second_last'>$second_last</a></li>";
									echo "<li><a href='gameadmin.php?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
									}

								 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
									echo "<li><a href='gameadmin.php?page_no=1'>1</a></li>";
									echo "<li><a href='gameadmin.php?page_no=2'>2</a></li>";
									echo "<li><a>...</a></li>";
									for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
									   if ($counter == $page_no) {
									   echo "<li class='active'><a>$counter</a></li>";	
											}else{
									   echo "<li><a href='gameadmin.php?page_no=$counter'>$counter</a></li>";
											}                  
								   }
								   echo "<li><a>...</a></li>";
								   echo "<li><a href='gameadmin.php?page_no=$second_last'>$second_last</a></li>";
								   echo "<li><a href='gameadmin.php?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
										}
									
									else {
									echo "<li><a href='gameadmin.php?page_no=1'>1</a></li>";
									echo "<li><a href='gameadmin.php?page_no=2'>2</a></li>";
									echo "<li><a>...</a></li>";

									for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
									  if ($counter == $page_no) {
									   echo "<li class='active'><a>$counter</a></li>";	
											}else{
									   echo "<li><a href='gameadmin.php?page_no=$counter'>$counter</a></li>";
											}                   
											}
										}
								}
							?>
								
								<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
								<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
								</li>
								<?php if($page_no < $total_no_of_pages){
									echo "<li><a href='gameadmin.php?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
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