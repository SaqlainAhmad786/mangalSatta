<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
	}
    define('MyConst', TRUE);
    if(empty($_SESSION['username']) and empty($_SESSION['usermobile']))
    {
    	header("location:index.php");
    } 
    if(!empty($_GET['logout']))
    {
    	$val = $_GET['logout'];
    	if($val=="yes")
    	{
        	session_destroy();
        	header("location:index.php");
    	}
    }
    $un = $_SESSION['usermobile'];
?>
<?php include("header.php");?>
<?php
$result = mysqli_query($link,"select * from user where mobile='$un'");
$record = mysqli_fetch_assoc($result);
?>
<body>
        <?php include("nav.php");?>
        
<div class="card card-body m-2" style="background: #fff;">
<div class="container" data-aos="fade-up">
        <h4>Profile</h4>
        <!--STATUS-->		
			<?php
				if(!empty($_SESSION['status']))
				{
			?>
					<div class="alert alert-danger font-weight-bold text-center" role="alert"><?=$_SESSION['status']?></div>
			<?php
					unset($_SESSION['status']);
				}
			?>
			</div>
	<div class="mx-auto text-center">
		<div class="user-pic"><img src="user_images/<?=$record['image']?>" onerror="this.onerror=null;this.src='user_images/default-image.jpg';" class="rounded-circle" height="100
    "width="100" alt="profile"></div>
		<div class="mx-auto pt-2"><h3 class="font-weight-bold text-danger"><?=$record['name']?></h3> <span class="text-dark">Tags Lines</span></div>
	</div>
	
	<div class="pt-2">
	    <div class="alert alert-info" role="alert">
 		Name: <?=$record['name']?>
		</div>
	    <div class="alert alert-info" role="alert">
 		Mobile: <?=$record['mobile']?>
 		</div>
		<div class="alert alert-info">
 		    <a href="/update-profile.php?link=ci" class="link">
 		   <?php
                        if(empty($record['image']))
                        {
                    ?>
                    Upload Image(Image not uploaded)
                    <?php
                        }
                        else
                        {
                    ?>
                        Change Profile Pic
                    <?php
                        }
                    ?>
 		    </a>
		</div>
		<div class="alert alert-info">
 		<a href="/update-profile.php?link=cp" class="link">Change Password</a>
		</div>
	    <div class="alert alert-info">
 		<a href="/profile.php?logout=yes" class="link">Logout</a>
	    </div>
	</div>
</div>
   
<?php include("footer.php");?>