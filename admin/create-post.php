<?php
session_start();
$aname = $_SESSION['adminname'];
$aemail = $_SESSION['adminemail'];

include("database.php");

extract($_POST);
if(isset($addpost))
{   
    $error = "";
	$pt_valid = false;
    $pt = trim($pt);
    if(!empty($pt))
    {
        $pt_valid = TRUE;
    }
    else
    {
        $error = "Enter Valid Post!";
    }
    if($pt_valid==true)
    {
        $desig = $_SESSION['designation'];
       
        $sql = "INSERT INTO post_( `name`, `designation`, `post`) VALUES ('$aname','$desig','$pt')";
        if (mysqli_query($link, $sql))
        {   
            $_SESSION['status'] = "Posted Successfully";
			header("location:post.php");
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
								<h1>Create New Post</h1>
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
											<label for="name">Enter Post</label>
											<input type="text" name="pt" id="pt" class="form-control" placeholder="Enter Post">	
										</div>
										<?php
    										if(!empty($error))
    										{
    								    ?>    
										    <label class="text-danger"><?=$error?></label>
									    <?php
										    }
										?>
									</div>								
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<input type="Submit" name="addpost" class="btn btn-primary" Value="Submit">
							<a href="post.php" class="btn btn-outline-dark ml-3">Cancel</a>
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