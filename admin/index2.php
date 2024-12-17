<?php
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
if(!empty($_SESSION['gadminname']) and !empty($_SESSION['gadminemail']))
{
	?>
	<script>location.href = "gdashboard.php";</script>
	<?php
} 
?>
<?php
include("database.php");
extract($_POST);
if(isset($login))
{
	$em = trim($em);
	$pass = trim($pass);
	$em_error = $pass_error = "";
	$em_valid = $pass_valid = false;
	// email validation
	if(!empty($em))
	{
		$format = "/^[a-zA-Z0-9_]+@[a-zA-Z]+\.[a-zA-Z]{2,3}$/";
		if(preg_match($format,$em))
		{
			$result = mysqli_query($link,"select * from gameadmin where email='$em'");
			$record = mysqli_num_rows($result);
			if(!empty($record))
			{
				$em_valid = true;
			}
			else
			{
				$em_error = "Email ID Not Exist";
			}
		}
		else
		{
			$em_error = "Enter Valid Email ID";
		}
	}
	else
	{
		$em_error = "Enter Email ID";
	}
	// password validation
	if(!empty($pass))
	{
		if(strlen($pass)>=4 && strlen($pass)<=10)
		{
			$pass_valid = true;
		}
		else
		{
			$pass_error = "Password Must Between 4 To 10 Characters";
		}
	}
	else
	{
		$pass_error = "Enter Password";
	}
	if($em_valid && $pass_valid == true)
	{
		// if no error in validation
		$result = mysqli_query($link,"SELECT gameadmin.id,gameadmin.name,gameadmin.email,gameadmin.game,gameadmin.password,gameadmin.approve,game.gamename FROM gameadmin,game WHERE gameadmin.game=game.id AND email='$em'");
		$arr = mysqli_fetch_assoc($result);
		$approve = $arr['approve'];
		if(md5($pass) == $arr['password'])
		{	session_start();
			session_destroy();
		    if(session_id() == '') {
                session_start();
            }
		    $_SESSION['designation'] = "ADMIN";
		    $_SESSION['gadminname'] = $arr['name'];
			$_SESSION['gadminemail'] = $arr['email'];
			$_SESSION['game'] = $arr['gamename'];
			if($arr['approve']==1)
			{
			?>
            	<script>location.href = "gdashboard.php";</script>
        	<?php
        	}
			else
			{
			    echo '<script>alert("Your account has not been approved. Contact adminstrator.")</script>'; 
			    session_destroy();
			}
		}
		else
		{
			$pass_error = "Enter Correct Password";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>GALI2</title>
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="css/adminlte.min.css">
		<link rel="stylesheet" href="css/custom.css">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Game Admin Panel</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Sign in to start your session</p>
					<form  method="post">
				  		<div class="input-group mb-3">
							<input type="email" name="em" value="<?php echo @$em;?>"class="form-control" placeholder="Email">
								
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-envelope"></span>
					  			</div>
							</div>
							<?php
									if(isset($em_error))
									{
										echo "<lable style='color:red;'>$em_error</lable>";
									}
									?>
				  		</div>
				  		<div class="input-group mb-3">
							<input type="password" name="pass" value="" class="form-control" placeholder="Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock"></span>
					  			</div>
								<?php
								if(isset($pass_error))
								{
									echo "<lable style='color:red;'>$pass_error</lable>";
								}
								?>
							</div>
				  		</div>
				  		<div class="row">
							<!-- /.col -->
							<div class="col-8">
					  			<input type="Submit" name="login" class="btn btn-primary" Value="LOGIN">
					  			<a href="../index.php" class="btn btn-danger">HOME</a>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
		  		</div>
			  	<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- ./wrapper -->
		<!-- jQuery
		<script src="plugins/jquery/jquery.min.js"></script>	 -->
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="js/adminlte.min.js"></script>
		<!-- AdminLTE for demo purposes 
		<script src="js/demo.js"></script> -->
	</body>
</html>