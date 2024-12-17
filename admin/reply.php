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
if(!empty($_GET['id']))
{
	$pid = $_GET['id'];
}
?>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Are you sure?');
}
</script>
<?php
//Delete Reply
if(!empty($_GET['delid']))
{
	$did = $_GET['delid'];
	if(mysqli_query($link,"delete from reply where id='$did'"))
	{
		$message = "Reply Delete Successfully";
		header("location:reply.php?id=$pid&&msg=$message");
	}
	else
	{
		$error .= mysqli_error($link);
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
                    // delete category message
                    
                    if(!empty($_GET['msg']))
                    {
                    ?>
                    	<label class="alert-info"><?=$_GET['msg']?></label>
                    <?php	
                    }
                    ?>

					
			<div class="container-fluid">
			<?php
			$r = mysqli_query($link,"select * from post where id='$pid'");
			while($ar = mysqli_fetch_assoc($r))
			{
			?>
			<table class="table table-hover text-nowrap">
				<tr class="text-primary">
					<th width="100">Original Post</th>
					<th width="100">Posted By</th>
					<th width="100">Date</th>
				</tr>
				<tr class="text-info">
					<td><?=$ar['post']?></td>
					<td><?=$ar['postedby']?></td>
					<td><?=$ar['tm']?></td>
				</tr>
			</table>
			<?php
			}
			?>
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
											<th width="60">ID</th>
											<th>Reply</th>
											<th width="100">Reply By</th>
											<th width="100">Date/Time</th>
											<th width="60">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$ctr = 1;
										$result = mysqli_query($link,"select * from reply where post_id='$pid' order by date desc");
										while($arr = mysqli_fetch_assoc($result))
										{
									?>
										<tr>
											<td><?=$ctr?></td>
											<td><?=$arr['reply']?></td>
											<td><?=$arr['reply_by']?>/<?=$arr['desig']?></td>
											<td><?=$arr['date']?></td>
											<td><a href="reply.php?id=<?=$pid?>&&delid=<?=$arr['id']?>" class="text-danger w-4 h-4 mr-1" onclick="return checkDelete()">
													<svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
												  	</svg>
												</a>
											</td>
										</tr>
									<?php
										$ctr++;
										}
									?>
									
									</tbody>
								</table>										
							</div>
							
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