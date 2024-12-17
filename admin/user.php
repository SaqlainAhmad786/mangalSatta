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
?>

<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
function checkDisable(){
    return confirm('Are you sure?');
}
</script>
<?php
if(!empty($_GET['uid']))
{
	$uid = $_GET['uid'];
}
else
{
	$uid = NULL;
}
//Delete Reply
if(!empty($_GET['delid']))
{
	$did = $_GET['delid'];
	if(mysqli_query($link,"delete from user where id='$did'"))
	{
		$message = "User Account Delete Successfully";
		header("location:reply.php?msg=$message");
	}
	else
	{
		$error .= mysqli_error($link);
	}
}
//Activate User Profile
if(!empty($_GET['activeid']))
{
	$activeid = $_GET['activeid'];
	if(mysqli_query($link,"UPDATE user SET approve = 1 WHERE id = '$activeid'"))
	{
		$message = "User Account Activated Successfully";
	}
	else
	{
		$error .= mysqli_error($link);
	}
}
//Disable User Profile
if(!empty($_GET['blockid']))
{
	$blockid = $_GET['blockid'];
	if(mysqli_query($link,"UPDATE user SET approve = 0 WHERE id = '$blockid'"))
	{
		$message = "User Account Disabled Successfully";
	}
	else
	{
		$error .= mysqli_error($link);
	}
}
extract($_POST);
//Paggination Phase-I
	if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    	$page_no = $_GET['page_no'];
	} else {
		$page_no = 1;
	}
	$total_records_per_page = 15;
	$offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
	$next_page = $page_no + 1;
	$adjacents = "2"; 
    $result_count = mysqli_query($link,"SELECT COUNT(*) As total_records FROM `user`");
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
	$total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; // total page minus 1
//paggination phas-I end
if(isset($search))
{
    echo "Table Search:".$table_search;
    $result = mysqli_query($link,"select * from user where name like '%$table_search%' OR mobile like '%$table_search%'");
}
else
{
    $result = mysqli_query($link,"SELECT * FROM user ORDER BY name LIMIT $offset, $total_records_per_page");
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
							<h1>Posts Reply</h1>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<?php
                    // User Status message
                    if($message)
                    {
                    ?>
                    	<label class="alert-info"><?=$message?></label>
                    <?php
                    $message = NULL;
                    }
                    ?>
					<?php
                    // delete category message
                    
                    if(!empty($_GET['msg']))
                    {
                    ?>
                    	<label class="alert-info"><?=$_GET['msg']?></label>
                    <?php	
                    }
                    ?>
					<?php
						//Password Change Status
						if(!empty($_SESSION['status']))
						{
					?>
							<label class="alert-success"><?=$_SESSION['status']?></label>
					<?php
							unset($_SESSION['status']);
						}
					?>
<?php

?>					
			<div class="container-fluid">
						<div class="card">
							<div class="card-header">
								<div class="card-tools">
									<form method="POST">
									<div class="input-group input-group" style="width: 250px;">
										<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
										<div class="input-group-append">
										  <button type="submit" class="btn btn-default form-control" name="search">
											<i class="fas fa-search"></i>
										  </button>
										</div>
								    </div>
								    </form>
								</div>
							</div>
							<div class="card-body table-responsive p-0">								
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">ID</th>
											<th>Name</th>
											<th width="100">UserName</th>
											<th width="100">Mobile</th>
											<th width="100">Image</th>
											<th width="100">Date</th>
											<th width="60">Profile</th>
											<th width="60">Status</th>
											<th width="60">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$ctr = 1;
										while($arr = mysqli_fetch_assoc($result))
										{
									?>
										<?php
										if($arr['id']==$uid)
										{
										?>
										<tr class="text-primary" bgcolor="lightyellow">
											<td><?=$ctr?></td>
											<td><?=$arr['name']?></td>
											<td><?=$arr['username']?></td>
											<td><?=$arr['mobile']?></td>
											<td><a href="../user_images/<?=$arr['image']?>" target="_blank"><img src="../user_images/<?=$arr['image']?>" height="30" width="50"></a></td>
											<td><?=$arr['date']?></td>
											<td>
											    <?php
											    if(!empty($arr['profile'])){
											    ?>
											    <?=$arr['profile']?>
											    <?php
											    } else{
											    ?>
											    Member
											    <?php
											    }
											    ?>
											</td>
											<td>
											    <?php
											    if($arr['approve']==0){
											    ?>
												<label class="text-danger">Disabled</label><a href="user.php?activeid=<?=$arr['id']?>">
													<img src="img/check.png" width="15" height="15">
												</a>
												<?php
											    }else{
											    ?>
												<label class="text-success">Active</label><a href="user.php?blockid=<?=$arr['id']?>" class="text-danger w-4 h-4 mr-1" onclick="return checkDisable()">
													<img src="img/cross.png" width="15" height="15">
												</a>
												<?php
											    }
											    ?>
											</td>
											<td>
												<a href="editpassword.php?uid=<?=$arr['id']?>">
													<svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
													</svg>
												</a>
												
												<a href="user.php?delid=<?=$arr['id']?>" class="text-danger w-4 h-4 mr-1" onclick="return checkDelete()">
													<svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
												  	</svg>
												</a>
											</td>
										</tr>
										<?php
										}
										else
										{
										?>	
										<tr>
											<td><?=$ctr?></td>
											<td><?=$arr['name']?></td>
											<td><?=$arr['username']?></td>
											<td><?=$arr['mobile']?></td>
											<td><a href="../user_images/<?=$arr['image']?>" target="_blank"><img src="../user_images/<?=$arr['image']?>" height="30" width="50"></a></td>
											<td><?=$arr['date']?></td>
											<td>
											    <?php
											    if(!empty($arr['profile'])){
											    ?>
											    <?=$arr['profile']?>
											    <?php
											    } else{
											    ?>
											    Member
											    <?php
											    }
											    ?>
											</td>
											<td>
											    <?php
											    if($arr['approve']==0){
											    ?>
												<label class="text-danger">Disabled</label><a href="user.php?activeid=<?=$arr['id']?>">
													<img src="img/check.png" width="15" height="15">
												</a>
												<?php
											    }else{
											    ?>
												<label class="text-success">Active</label><a href="user.php?blockid=<?=$arr['id']?>" class="text-danger w-4 h-4 mr-1" onclick="return checkDisable()">
													<img src="img/cross.png" width="15" height="15">
												</a>
												<?php
											    }
											    ?>
											</td>
											<td>
												<a href="editpassword.php?uid=<?=$arr['id']?>">
													<svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
													</svg>
												</a>
												
												<a href="user.php?delid=<?=$arr['id']?>" class="text-danger w-4 h-4 mr-1" onclick="return checkDelete()">
													<svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
												  	</svg>
												</a>
											</td>
										</tr>
										<?php
										}
										?>
									<?php
										$ctr++;
										}
									?>
								</tbody>
							</table>										
						</div>
						<!--Footer for pagenumber	-->
						<?php
						if(!$table_search){
						?>
							<div style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
							<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
							</div>

							<ul class="pagination">
								<?php // if($page_no > 1){ echo "<li><a href='user.php?page_no=1'>First Page</a></li>"; } ?>
								
								<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
								<a <?php if($page_no > 1){ echo "href='user.php?page_no=$previous_page'"; } ?>>&nbsp;Previous</a>
								</li>
								   
								<?php 
								if ($total_no_of_pages <= 10){  	 
									for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
										if ($counter == $page_no) {
									   echo "<li class='active'><a>&nbsp;$counter</a></li>";	
											}else{
									   echo "<li><a href='user.php?page_no=$counter'>&nbsp;$counter</a></li>";
											}
									}
								}
								elseif($total_no_of_pages > 10){
									
								if($page_no <= 4) {			
								 for ($counter = 1; $counter < 8; $counter++){		 
										if ($counter == $page_no) {
									   echo "<li class='active'><a>&nbsp;$counter</a></li>";	
											}else{
									   echo "<li><a href='user.php?page_no=$counter'>&nbsp;$counter</a></li>";
											}
									}
									echo "<li><a>...</a></li>";
									echo "<li><a href='user.php?page_no=$second_last'>&nbsp;$second_last</a></li>";
									echo "<li><a href='user.php?page_no=$total_no_of_pages'>&nbsp;$total_no_of_pages</a></li>";
									}

								 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
									echo "<li><a href='user.php?page_no=1'>&nbsp;1</a></li>";
									echo "<li><a href='user.php?page_no=2'>&nbsp;2</a></li>";
									echo "<li><a>...</a></li>";
									for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
									   if ($counter == $page_no) {
									   echo "<li class='active'><a>&nbsp;$counter</a></li>";	
											}else{
									   echo "<li><a href='user.php?page_no=$counter'>&nbsp;$counter</a></li>";
											}                  
								   }
								   echo "<li><a>...</a></li>";
								   echo "<li><a href='user.php?page_no=$second_last'>&nbsp;$second_last</a></li>";
								   echo "<li><a href='user.php?page_no=$total_no_of_pages'>&nbsp;$total_no_of_pages</a></li>";      
										}
									
									else {
									echo "<li><a href='user.php?page_no=1'>&nbsp;1</a></li>";
									echo "<li><a href='user.php?page_no=2'>&nbsp;2</a></li>";
									echo "<li><a>...</a></li>";

									for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
									  if ($counter == $page_no) {
									   echo "<li class='active'><a>&nbsp;$counter</a></li>";	
											}else{
									   echo "<li><a href='user.php?page_no=$counter'>&nbsp;$counter</a></li>";
											}                   
										}
									}
								}
							?>
								<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
								<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>&nbsp;Next</a>
								</li>
								<?php if($page_no < $total_no_of_pages){
									echo "<li><a href='user.php?page_no=$total_no_of_pages'>&nbsp;Last &rsaquo;&rsaquo;</a></li>";
									} ?>
							</ul>
						<?php
						    }
						?>
							<!--Pagination code End-->
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