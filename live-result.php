<?php
if(!defined('MyConst')) {
   die('Direct access not permitted');
}
?>
<style type="text/css">
#borderimg { 
  border: 10px solid transparent;
  padding: 15px;
  border-image: url(border.png) 30 stretch;
}
.live {
    background: linear-gradient(90deg,#AF1740 7.64%,#D6CFB4 99.83%);
    border-radius: 0 20%/0 100% 10%;
    color: white;
    font-weight: bold;
    text-shadow: 1px 2px 3px #000;
    
}
.live-game {
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    background: linear-gradient(to right, red, blue);
    color: transparent;
    -webkit-background-clip: text;
    text-shadow: 0 0 60px red;
    animation: anime 1s infinite alternate;
}
@keyframes anime {
    100% {
        text-shadow: 0 0 60px blue;

    }
}
.live-number {
    color: #000;
    text-shadow: 2px 2px 2px #fbbd10;
}
</style>

<div class="wow fadeInUp text-center m-2" id="borderimg">
        
            <div class="live p-1">Live Results</div>
            <div class="text-danger" style="font-size: 16px; font-weight: bold;">
            <?php
    	    //$myDate = date("d M, Y h:i:s a"); 
                date_default_timezone_set('Asia/Kolkata');
	            $currentTime = date( 'd M,Y h:i A', time () );
        	// Display the date and time  
        	echo $currentTime;  
    	    ?>
            </div>
            <p class="blinking"><b>हा भाई यही आती हे सबसे पहले खबर रूको और देखो</b></p>
            <?php
    $r_cur = mysqli_query($link,"select * from current");
    while ($ar_cur = mysqli_fetch_assoc($r_cur))
    {
?>
            <h2 class="live-game p-1"><?=$ar_cur['gname']?></h2>
            <h6 class="live-number" style="font-size: 50px; font-weight: bold;"><?=$ar_cur['number']?></h6>
            <?php
    }
?>

</div>
