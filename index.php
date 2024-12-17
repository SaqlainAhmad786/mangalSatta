<?php
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
	}
	if(isset($_SESSION['username'])&&isset($_SESSION['usermobile']))
	{
		$un = $_SESSION['username'];
		$um = $_SESSION['usermobile'];
	}
?>
<?php
define('MyConst', TRUE);
?>
<?php include("header.php")?>
<body id="page-top" data-gr-c-s-loaded="true">
    <header class="bg-warning text-white">
         <div id="particles-js">
            <canvas class="particles-js-canvas-el" width="1903" height="1115" style="width: 100%; height: 100%;"></canvas>
        </div>
       <?php include("nav.php");?>
<section class="banner-block wow fadeInDown" id="banner" style="overflow-x:hidden;">
	<div class="pb-4 mb-4">
		<div class="row pb-5 mb-5">
			<div class="col-md-12 text-center">
				<div class="text-danger" style="font-size: 25px; font-weight: bold;"><span style="background-color: #fff; border-radius: 6px; padding-inline: 6px;">LIVE RESULT</span></div>
				<div class="text-body" style="font-size: 22px; font-weight: bold; letter-spacing: 2px;">
					<?php
    	    //$myDate = date("d M, Y h:i:s a"); 
                date_default_timezone_set('Asia/Kolkata');
	            $currentTime = date( 'd M,Y h:i A', time () );
        	// Display the date and time  
        	echo $currentTime;  
    	    ?>
				</div>
				<div class="blinking" style="color: #D39D55">हा भाई यही आती हे सबसे पहले खबर रूको और देखो</div>
			</div>
			<div class="col-md-12 py-5 my-5 text-center">
				<?php
    $r_cur = mysqli_query($link,"select * from current");
    while ($ar_cur = mysqli_fetch_assoc($r_cur))
    {
?>
				<p class="pt-4 text-light" style="text-shadow: 1px 1px 4px #000000; font-weight: bold; font-size: 70px;"><?=$ar_cur['number']?></p>
				<h1 style="text-shadow: 1px 1px 2px #000000; color: #D39D55; font-weight: bold;"><strong><?=$ar_cur['gname']?></strong></h1>
				<?php
    }
?>
			<div class="text-center" style="padding-top: 50px;">
                    <a href="posting.php" class="btn btn-danger"><b>Go To Guessing</b></a>
                </div>	
			</div>
		</div>
	</div>
</section>
        <div class="effectiv wow fadeInUp">
            <img class="svg" src="images/bg2.svg" alt="Satta king 786">
        </div>
    </header>
    
<!-- content -->
<div class="wow fadeInUp">
<div class="justify-content-center text-center"><img src="images/gali2-logo.png" width="160" alt="GALI2"></div>
</div>
<div class="text-center m-2">
    <div><b>Any Information Contact Admin 91234-56789</b></div>
</div>
<div class="text-center p-3 m-2 rounded shadow-sm" style="background: linear-gradient(#D6CFB4, #D39D55);">
<h1 class="font-weight-bold text-light" style="font-size: 22px; text-shadow: 2px 2px 8px #000;">GALI2</h1>
    <p class="text-danger"><b>GALI2 Most Popular Trusted Online Khaiwal And Result Provider.</b></p>
</div>
<!-- end content -->
<?php include("lucky-satta-number-today.php")?>


    <!-- Live Results -->
<?php include("charts.php")?>
    <!-- End Results Today and Last -->
    
<!-- ads area -->
<?php include("include/ads1.php")?>

<?php include("include/ads2.php")?>
<!-- ads area -->


  
    
   <!-- Result of selected month start -->
    <?php include("search.php")?> 
    <!-- Result of selected month end -->
    <?php include("monthreport.php")?>    



<!--
    <section class="features-mid-block" id="features-mid">
    <?php
        $result = mysqli_query($link,"select * from post order by tm desc");
		while($arr = mysqli_fetch_assoc($result))
		{
	?>
        <div class="container bg-warning">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="features-mid-right text-left">
                        <div class="card bg-warning">
                            <div class="card-body">
                                <center>
                                    <h2 class="text-white"><?=$arr['post']?></h2>
                                    <h5 class="text-white">Site Owner</h5>
                                    <h5 class="text-white"><?=$arr['tm']?></h5>
                                    <a href="index.php"><button type="button" class="btn btn btn-info">Refresh</button></a>
                                    <?php
									$pid=$arr['id'];
                                    if(!empty($un) && !empty($um))
                                    {
                                    ?>
									<a href="post.php?id=<?=$arr['id']?>&&desig=Member&&un=<?=$_SESSION['username']?>"><button type="button" class="btn btn btn-warning">Reply</button></a>
                                    <?php
                                    }
									else if($_SESSION['adminname'] && $_SESSION['adminemail'])
									{
										$desig = "Site Owner";
									?>
										<a href="post.php?id=<?=$arr['id']?>&&desig=<?=$desig?>&&un=<?=$_SESSION['adminname']?>"><button type="button" class="btn btn btn-warning">Reply</button></a>
									<?php
									}
                                    else if($_SESSION['gadminname'] && $_SESSION['gadminemail'])
									{
										$desig = "Admin";
									?>
										<a href="post.php?id=<?=$arr['id']?>&&desig=<?=$desig?>&&un=<?=$_SESSION['gadminname']?>"><button type="button" class="btn btn btn-warning">Reply</button></a>
									<?php
									}
                                    else
                                    {   $msg = "Login to Reply!";
                                    ?>
                                        <a href="login.php?msg=<?=$msg?>"><button type="button" class="btn btn btn-warning" data-toggle="tooltip" title="Login to Reply!">Reply</button></a>
                                    <?php
                                    }
                                    ?>
                                </center>
                            </div>
							<table>
							<?php
								$r1 = mysqli_query($link,"select * from reply where post_id='$pid' order by date");
								while($a1 = mysqli_fetch_assoc($r1))
								{
							?>
									<tr><center><label class="text-white"><?=$a1['reply']?> Replied By:<?=$a1['reply_by']?>/<?=$a1['desig']?></label></center></tr>
							<?php
								}
							?>	
							</table>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    <?php
        echo "<br>";
		}
	?>
    </section>
    -->
    
<?php include("footer.php");?>