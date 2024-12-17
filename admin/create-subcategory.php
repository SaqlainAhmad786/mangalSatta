<?php

include("database.php");

extract($_POST);
if(isset($addresult))
{   $result_error = "";
	$result_valid = false;
	if(!empty($result))
	{	
		$rs=mysqli_query($link,"SELECT count(*) as total from result where gamename = '$gamename' and dt = '$dt'");
		$data=mysqli_fetch_assoc($rs);
		$tl = $data['total'];
		if(($result>=0)&&($result<100)&&($tl==0))
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
        $sql = "INSERT INTO result (gamename,result,dt) VALUES ('$gamename','$result','$dt')";
        if (mysqli_query($link, $sql))
        {   
        /*  echo "New record created successfully"; */
            $_SESSION['status'] = "Result Added Successfully";
			header("location:subcategory.php");
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
								<h1>Create Sub Category</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="subcategory.php" class="btn btn-primary">Back</a>
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
                                    <div class="col-md-12">
										<div class="mb-3">
											<label for="name">Game Name</label>
											<select name="gamename" id="gamename" class="form-control">
                                                <option value="" hidden>Select</option>
                                                <?php
													$result = mysqli_query($link,"select * from game where enable = 1  order by gamename");
													while($arr = mysqli_fetch_assoc($result))
													{
													?>
														<option value="<?=$arr['gamename']?>"><?=$arr['gamename']?></option>
													<?php
													}
												?>
                                            </select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Result</label>
											<input type="number" name="result" id="result" class="form-control" required placeholder="Result">	
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="date">Date</label>
											<input type="date" name="dt" id="dt" class="form-control" required placeholder="Date">	
										</div>
									</div>									
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<input type="Submit" name="addresult" class="btn btn-primary" Value="Submit">
							<a href="subcategory.php" class="btn btn-outline-dark ml-3">Cancel</a>
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