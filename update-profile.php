<?php
	if (session_status() === PHP_SESSION_NONE) {
    session_start();
	}
define('MyConst', TRUE);
if(empty($_SESSION['username']) and empty($_SESSION['usermobile']))
{
	header("location:index.php");
} 
?>
<?php
include("admin/database.php");
$un = $_SESSION['usermobile'];
extract($_POST);
if(isset($cpass))
{   
	$op = trim($op);
	$np = trim($np);
	$cp = trim($cp);
	$id = null;
	$error = "";
	$pass_valid = false;
	if((!empty($op))&&(!empty($np))&&(!empty($cp)))
	{
	    if($np==$cp)
	    {
	        $result = mysqli_query($link,"select * from user where mobile='$un'");
		    $record = mysqli_fetch_assoc($result);
		    $id = $record['id'];
		    if(md5($op)==$record['password'])
		    {
		        $pass_valid = TRUE;
		    }
		    else
		    {
		        $error.= "Old Password Not Match<br>";
		    }
	    }
	    else
		{
	        $error.= "New Password and Confirm Password Not Match<br>";
	    }
	}
	else
	{
		$error.= "Please fill all fields.<br>";
	}
	if($pass_valid == true)
	{
		// if no error in validation
		$passwd = MD5($np);
		echo "ID::".$id;
		if(mysqli_query($link,"UPDATE user SET password = '$passwd' WHERE id = '$id'"))
		{				
			$_SESSION['status'] = "Password Changed Successfully!";
			header("location:profile.php");
			exit;				
		}
		else
		{
		    $error.= "Unable to Change Password. Try Again!<br>".mysqli_error($link);
		}
	}
}


if(isset($change_image))
{   echo "change image";
    $error = "";
    $img_valid = false;
	$fn = $_FILES['att']['name'];
	$tmp = $_FILES['att']['tmp_name'];
	if(!empty($fn))
	{
		$ext = pathinfo($fn,PATHINFO_EXTENSION);
		$ext = strtolower($ext);
		echo "<br>File found";
		if($ext=="jpg" || $ext=="jpeg" ||$ext=="png")
		{
			$img_valid = true;
			echo "<br>File valid";

		}
		else
		{
			$error .= "Only jpg/jpeg/png file supported <br>";
		}
	}
	else
	{
		$error .= "Choose File <br>";
	}
	
	if($img_valid == true)
	{
        $result = mysqli_query($link,"select * from user where mobile='$un'");
	    $record = mysqli_fetch_assoc($result);
	    $image = $record['image'];
	    echo "<br>Old file:".$image;
	    $fnn = uniqid().'.'.$ext;
		if(move_uploaded_file($tmp,"user_images/".$fnn))
		{
		    mysqli_query($link,"UPDATE user SET image = '$fnn' WHERE mobile = '$un'");
		    unlink("user_images/".$image);
			$_SESSION['status'] = "Image Changed Successfully!";
			header("location:profile.php");
			exit;				
		}
		else
		{
		    $error.= "Error in Uploading Image. Try Again!<br>";
		}
	}
}
?>
<?php include("header.php");?>

<body id="page-top" data-gr-c-s-loaded="true">
    <header class="bg-warning text-white">
        <div id="particles-js">
            <canvas class="particles-js-canvas-el" width="1903" height="1115" style="width: 100%; height: 100%;"></canvas>
        </div>
        <?php include("nav.php");?>
<?php
if ($_GET['link']=="cp")
{
?>
<section class="trial-block" id="trial">
        <div class="container">
            <div class="section-title pb-3 text-center">
                <h2>Please Enter</h2>
            <?php
				if(!empty($error))
				{
			?>
			<!--		<label class="alert-danger"><?=$error?></label> -->
					<span class="alert-danger"><?=$error?></span>
			<?php
				}
			
			?>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto wow fadeInUp">
                    <form name="sentMessage" method="post">
                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="password" placeholder="Old Password" class="form-control" name="op" id="op" required="" data-validation-required-message="Please enter Old Password.">
                                <p class="help-block"></p>
                            </div>
                        </div>
						<div class="control-group form-group">
                            <div class="controls">
                                <input type="password" placeholder="New Password" class="form-control" name="np" id="np" minlength="5" required="" data-validation-required-message="Please enter New Password.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group form-group wow fadeInUp">
                            <div class="controls">
                                <input type="password" placeholder="Confirm Password" class="form-control" name="cp" id="cp" minlength="5" required="" data-validation-required-message="Please enter Confirm Password.">
                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn btn-warning btn-lg btn-block" name="cpass">Submit</button>
					<!--	<input type="Submit" name="login" class="btn btn-warning" Value="LOGIN">    
					-->		
                    </form>
				</div>
            </div>
        </div>
    </section>
<?php
} 
else 
{
?>
    <section class="trial-block" id="trial">
        <div class="container">
            <div class="section-title pb-3 text-center">
                <h2>Pease Attach Image File</h2>
            <?php
				if(!empty($pass_error))
				{
			?>
					<span class="label info"><?=$error?></span>
			<?php
				}
			
			?>
            
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto wow fadeInUp">
                    <form name="sentMessage" method="post" enctype="multipart/form-data">
                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="file" placeholder="Image." class="form-control" name="att" id="att" required="" data-validation-required-message="Please attach image.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                        <button type="submit" class="btn btn btn-warning btn-lg btn-block" name="change_image">Submit</button>
					<!--	<input type="Submit" name="login" class="btn btn-warning" Value="LOGIN">    -->
							
                    </form>
				</div>
            </div>
        </div>
    </section>
<?php
}
?>
<?php include("footer.php");?>