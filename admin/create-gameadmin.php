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
if(isset($addgameadmin))
{   $game_error = "";
	$email_valid = $game_valid = $pass_valid = false;
    $result = mysqli_query($link,"select * from gameadmin where email='$email'");
	$record = mysqli_num_rows($result);
	if(empty($record))
	{
		$email_valid = true;
	}
	else
	{
		$game_error .= "Email allready exist";
	}
	$result = mysqli_query($link,"select * from gameadmin where game='$game'");
	$record = mysqli_num_rows($result);
	if(empty($record))
	{
		$game_valid = true;
	}
	else
	{
		$game_error .= "<br>Admin for selected game allready exist";
	}
	if($password==$cpassword)
	{
		$pass_valid = true;
	}
	else
	{
		$game_error .= "<br>Password and Confirm Password Mismatch.";
	}
    if(($game_valid==true)&&($email_valid==true)&&($pass_valid==true))
    {
        $sql = "INSERT INTO gameadmin (name,email,password,game) VALUES ('$gameadminname','$email',md5('$password'),'$game')";
        if (mysqli_query($link, $sql))
        {   
        /*  echo "New record created successfully"; */
            $_SESSION['status'] = "Game Admin Created Successfully";
            echo "<script>window.location.href='gameadmin.php'</script>";
		//	header("location:gameadmin.php");
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
								<h1>Create Game Admin</h1>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<?php
				if(!empty($game_error))
				{
					echo "<lable style='color:red;'>$game_error</lable>";
				}
				?>
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
											<label for="name">Game Admin Name</label>
											<input type="text" name="gameadminname" id="gameadminname" class="form-control" placeholder="Game Admin Name">	
										</div>
									</div>								
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Email</label>
											<input type="email" name="email" id="email" class="form-control" placeholder="Email">	
										</div>
									</div>								
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Password</label>
											<input type="password" name="password" id="password" class="form-control" placeholder="Password">	
										</div>
									</div>								
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Confirm Password</label>
											<input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password">	
										</div>
									</div>								
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Game Name</label>
											<select name="game" id="game" class="form-control">
                                                <option value="" hidden>Select</option>
                                                <?php
													$result = mysqli_query($link,"select * from game where enable = 1  order by gamename");
													while($arr = mysqli_fetch_assoc($result))
													{
													?>
														<option value="<?=$arr['id']?>"><?=$arr['gamename']?></option>
													<?php
													}
												?>
                                            </select>	
										</div>
									</div>								
								</div>

							</div>							
						</div>
						<div class="pb-5 pt-3">
							<input type="Submit" name="addgameadmin" class="btn btn-primary" Value="Submit">
							<a href="gameadmin.php" class="btn btn-outline-dark ml-3">Cancel</a>
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