<?php
	if (session_status() === PHP_SESSION_NONE) {
    session_start();
	}
define('MyConst', TRUE);
if(!empty($_SESSION['username']) and !empty($_SESSION['usermobile']))
{
	header("location:index.php");
} 

include("admin/database.php");

extract($_POST);
if(isset($register))
{   $error = "";
	$user_valid = $password_valid = False;
	$name = trim($name);
    $uname = trim($uname);
    $mobile = trim($mobile);
    $pass = trim($pass);
	$cp = trim($cp);
//	echo "<br>".$name."<br>".$uname."<br>".$mobile."<br>".$pass."<br>".$cp;
    if($pass == $cp)
	{
		$password_valid = true;
		$result = mysqli_query($link,"select * from user where mobile='$mobile' or username='$uname'");
		$record = mysqli_num_rows($result);
		if(empty($record))
		{
			$user_valid = true;
		}
		else
		{
			$error.= "UserName/Mobile allready exist.<br>";
		}
	}
	else
	{
		$error.= "Password mismatch.<br>";
	}
    if(($user_valid==true)&&($password_valid==true))
    {
	    $passwd = MD5($pass);
		$sql = "INSERT INTO user (name,username,mobile,password) VALUES ('$name','$uname','$mobile','$passwd')";
		if (mysqli_query($link, $sql))
		{   
			$_SESSION['status'] = "Registeration Successfully!<br>Login to your account!";
			header("location:login.php");
			exit;
		} 
		else 
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($link);
		}
    }
}
?>



<?php include("header.php");?>

<body id="page-top" data-gr-c-s-loaded="true">
    <header class="bg-warning text-white">
        
        <?php include("nav.php");?>

    <section class="trial-block" id="trial">
        <div class="container">
            <div class="section-title pb-3 text-center">
                <!-- <span class="badge badge-info">Get Started</span> -->
                <h2>REGISTER</h2>
                <!--<p class="">Contact us for succes of your business</p>-->
                <?php

				if(!empty($error))
				{
				?>
					<label class="text-light bg-primary"><?=$error?></label>
				<?php
				}

				?>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-8 col-12 mx-auto wow fadeInUp">
                    <form name="sentMessage" method="post"  enctype="multipart/form-data">
                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="text" placeholder="Full Name" class="form-control" style="border-radius: 6px;" name="name" id="name" required="" data-validation-required-message="Please enter your name.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="text" placeholder="User Name" class="form-control" style="border-radius: 6px;" name="uname" id="uname" required="" data-validation-required-message="Please enter your User Name.">
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="control-group form-group">
                            <div class="controls">
                                <input type="tel" name="mobile" pattern="[0-9]{10}" title="Ten digits Mobile Number" style="border-radius: 6px;" placeholder="Mobile" class="form-control" required/>
                                <div class="help-block"></div>
                            </div>
                        </div>
                       <!-- 
                        <div class="row wow fadeInUp">
                            <div class="control-group form-group col-md-6">
                                <div class="controls">
                                    <input type="tel" name="mobile" pattern="[0-9]{10}" title="Ten digits Mobile Number" placeholder="Mobile" class="form-control" required/>
                                    <div class="help-block"></div>
                                </div>
                            </div>
							<div class="control-group form-group col-md-6">
                                <div class="controls">
                                    <input type="file" placeholder="Image" class="form-control" name="att" id="att" required="" data-validation-required-message="Please select your image.">
                                    <div class="help-block"></div>
                                </div>
                            </div>  
                        </div>-->
                        <div class="row wow fadeInUp">
                            <div class="control-group form-group col-md-6">
                                <div class="controls">
                                    <input type="password" placeholder="Password" class="form-control" style="border-radius: 6px;" name="pass" id="pass" required="" data-validation-required-message="Please enter password.">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <div class="controls">
                                    <input type="password" placeholder="Confirm Password" class="form-control" style="border-radius: 6px;" name="cp" id="cp" required="" data-validation-required-message="Please re-enter password.">
                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="success"></div>
                        <!-- For success/fail messages -->
                         <div class='text-center'>
                             <button type="submit" class="btn" name="register">Register</button>
                            </div>
                    </form>
                    <br>
                    <center>
                        <h6 class="text-body ">Allready have Account!<a href="login.php" class="text-primary"> Login Her</a></h6>
                </center>
                </div>
            </div>
        </div>
    </section>



   <?php include("footer.php");?>