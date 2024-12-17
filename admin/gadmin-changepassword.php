<?php
session_start();
$aname = $_SESSION['gadminname'];
$aemail = $_SESSION['gadminemail'];


if(empty($aname))
{
	// if user is not login
	    echo "<script>window.location.href='index2.php'</script>";
    //header("location:index2.php");
}
else
{
	$pageaccess = true;
}
?>
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
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Administrative Panel</a>
			  	</div>
			  	<div class="card-body">
					<label id="message" class="text-info"></label>
					<p class="login-box-msg">Change Password</p>					
					<form  method="post">
						<div class="input-group mb-3">
							<input type="password" id="op" value="" class="form-control" placeholder="Old Password">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							<label class="text-danger" id="ope"></label>
						</div>
						<div class="input-group mb-3">
							<input type="password"  id="np"  class="form-control" >
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							<label class="text-danger" id="npe"></label>
						</div>
						<div class="input-group mb-3">
							<input type="password"  id="cp"  class="form-control">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							<label class="text-danger" id="cpe"></label>
						</div>
						<div class="row">
							<!-- /.col -->
							<div class="col-4">
								<input type="button"  value="Submit" id="sub" class="btn btn-success">
							</div>
							<div class="col-4">
								<a href = "index.php" class = "btn btn-danger">Close</a>
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
		<!-- Bootstrap 4 -->
		<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="js/bootstrap.min.js"></script>

		<script>

$(document).ready(function()
{
	$('#ope, #npe, #cpe').css("display","none");
	
	$('#sub').click(function()
	{
		//alert('hi');
		var op = $('#op').val();
		var np = $('#np').val();
		var cp = $('#cp').val();
		
		operror = nperror = cperror = "";
		op_valid = np_valid = cp_valid = false;

		// old password validation
		if(op.trim() != "")
		{
			op_valid = true;
		}
		else
		{
			operror = "Old Password Can Not Blank";
		}
		
		
		// new password validation
		
		if(np.trim() != "")
		{
			if(np.length >=4 && np.length<=10)
			{
				np_valid = true;
			}
			else
			{
				nperror = "New Password Must Between 4 To 10 Characters";
			}
		}
		else
		{
			nperror = "New Password Can Not Blank";
		}
		
		
		
		// change password validation
		
		if(cp.trim() != "")
		{
			if(cp.length >=4 && cp.length<=10)
			{
				if(np == cp)
				{
					cp_valid = true;
				}
				else
				{
					cperror = "New Password and Confirm Password Are Not Same";
				}
			}
			else
			{
				cperror = "Confirm Password Must Between 4 To 10 Characters";
			}
		}
		else
		{
			cperror = "Confirm Password Can Not Blank";
		}
		
		
		
		if(op_valid && np_valid && cp_valid == true)
		{
			// if no error validation 
			
			$.ajax({
				url : 'gadmin-cpapi.php',
				method : 'get',
				data : {opdata:op,npdata:np},
				success : function(res)
				{
					$('#message').html(res);
					$('#myform').trigger("reset");
					$('#ope, #npe, #cpe').css("display","none");
				},
				error : function()
				{
					alert('Not Working');
				}
			})
			
		}
		else
		{
			$('#myform').trigger("reset");
			$('#ope, #npe, #cpe').css("display","block");
			$('#ope').html(operror);
			$('#npe').html(nperror);
			$('#cpe').html(cperror);
		}
		
		
	})
})

</script> 
	</body>
</html>
