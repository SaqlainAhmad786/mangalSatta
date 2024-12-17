<?php
session_start();
if(empty($_SESSION['adminname']) and empty($_SESSION['adminemail']))
{
	echo "<script>window.location.href='index.php'</script>";
    //header("location:index.php");
} 
?>
<?php

include("database.php");
$uid = $_GET['uid'];
$result = mysqli_query($link,"select * from user where id='$uid'");
$arr = mysqli_fetch_assoc($result);
$username = $arr['username'];
if(!empty($arr['profile']))
{
    $profile = $arr['profile'];
}
else
{
    $profile = "Member";
}
extract($_POST);

if(isset($changepass))
{   
    $pass_ = 0;
	$pass = trim($pass);
	$pass_error = "";
	$pass_valid = false;
	
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
	if($pass_valid == true)
	{
		// if no error in validation
		$pass = MD5($pass);
		$sql = "UPDATE user SET password='$pass' WHERE id='$uid'";
        if (mysqli_query($link, $sql))
        {   
            $pass_ = 1;
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
	}
	if(!empty($designation))
	{
	    $sql = "UPDATE user SET profile='$designation' WHERE id='$uid'";
        if (mysqli_query($link, $sql))
        {
            $pass_ = 1;
        } 
        else 
        {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
	}
	if($pass_==1)
	{
	    $_SESSION['status'] = "User profile:".$username." Updated.";
	//	header("location:user.php?uid=$uid");
	    echo "<script>window.location.href='user.php?uid=$uid'</script>";
		exit;
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
					<a href="#" class="h3">Administrative Panel</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Edit User Account: <?=$arr['username']?>/<?=$arr['mobile']?></p>
					<form  method="post">
				  		<div class="input-group mb-3">
							<input type="text" name="pass" class="form-control" placeholder="New Password For User Account">
							<?php
								if(isset($pass_error))
								{
									echo "<lable style='color:red;'>$pass_error</lable>";
								}
							?>
				  		</div>
				  		<div class="input-group mb-3">
							<input type="text" name="designation" class="form-control" value="<?=$profile?>" placeholder="Designation For User Account">
							<?php
								if(isset($pass_error))
								{
									echo "<lable style='color:red;'>$pass_error</lable>";
								}
							?>
				  		</div>
				  		<div class="row">
							<!-- /.col -->
							<div class="col-4">
					  			<input type="Submit" name="changepass" class="btn btn-block btn-primary" Value="SUBMIT">
								<a href="index.php"><input type="button" class="btn btn-block btn-danger" value="EXIT"></a>
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