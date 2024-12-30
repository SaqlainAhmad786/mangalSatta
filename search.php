<?php
if(!defined('MyConst')) {
   die('Direct access not permitted');
}
?>
<?php
extract($_POST);
if(isset($search))
{
//	echo "Year::".$year_s;
//	echo "<br>Month::".$month_s;
    $result_month = true;
	$s9 = "SELECT * FROM result where year(dt) = '$year_s' and month(dt) = '$month_s'";
	$result9 = mysqli_query($link,$s9);
	$rowcount=mysqli_num_rows($result9);
	if($rowcount>0)
	{
		$items = array();
		$ctr = 0;
		$month_c = date("m");
		$date_c = date("d"); // Today's date
		$year_c = date("Y"); 
		$d_c = date('d', mktime(0,0,0,$month_c,($date_c),$year_c)); 
		$m_c = date('m', mktime(0,0,0,$month_c,($date_c),$year_c)); 
		$y_c = date('Y', mktime(0,0,0,$month_c,($date_c),$year_c));
		if(($y_c == $year_s)&&($m_c == $month_s))
		{
		    $cds = $d_c;
		}
		else
		{
		    $cds = cal_days_in_month(CAL_GREGORIAN,$month_s,$year_s);
		}
/*		echo "<br> Date(d_c)".$d_c;
		echo "<br> Date(cds)".$cds;
		echo "<br> Month".$m_c;
		echo "<br> Year".$y_c;
*/		
		$sql_s = "select DISTINCT gamename from result where enable = 1 ORDER by gamename ASC";	//where enable = 1
		$rs = mysqli_query($link,$sql_s);
		while($arrs = mysqli_fetch_assoc($rs))
		{
			$items[] = $arrs['gamename'];
			$ctr++;
		}
		$i = 0;
		while($i < $ctr)
		{	
			$date = array($items);
			$d = 1;
			while($d <= $cds)
			{	
				$data[$i][$d] = $d;
				$j = 0;
				$results = array($data);
				$sql3 = "select * from result where gamename = '$items[$i]' and year(dt) = '$year_s' and month(dt) = '$month_s' and day(dt) = '$d'";	//where enable = 1
				$r3 = mysqli_query($link,$sql3);
				while($arr = mysqli_fetch_assoc($r3))
				{	$results[$i][$d][$j] = $arr['result'];
				
				}
				$d++;
			}
			$i++;
		};
	}
	else
	{
		$result_month = false;
		echo '<script>alert("No data found for selected month")</script>';
	}
}
?>

    <div class="container bg-dark">
            <div class="row">
                <div class="col-md-8 mx-auto my-5 wow fadeInUp ">
                    <center><h4 class="text-danger">Search Report</h4></center>
                     <form method="POST" enctype="multipart/form-data">
                        <div class="control-group form-group">
                            <div class="amazing-dashboard-left  wow fadeInLeft">
                    	<select class="form-control bg-danger text-white" name="year_s" id="year_s">
							<option class="hidden" selected disabled>Select Year</option>
						<?php
							while ($fieldinfo1 = mysqli_fetch_assoc($r_year)) {	
                        ?>
							<option value=<?=$fieldinfo1['year']?>><?=$fieldinfo1['year']?></option>
						<?php												
							}
						?>
						</select>        
                    </div>
                        </div>
                        <div class="control-group form-group wow fadeInUp">
                            <div class="controls">
                                <select class="form-control bg-danger text-white" name="month_s" id="month_s">
							<option class="hidden" selected disabled>Select Month</option>
							<option value=01>01</option>
							<option value=02>02</option>
							<option value=03>03</option>
							<option value=04>04</option>
							<option value=05>05</option>
							<option value=06>06</option>
							<option value=07>07</option>
							<option value=08>08</option>
							<option value=09>09</option>
							<option value=10>10</option>
							<option value=11>11</option>
							<option value=12>12</option>
						</select>
                            </div>
                        </div>
                       
                        <!-- For success/fail messages -->
						 <div class="text-center">

							 <button type="submit" class="btn btn-light" name="search">Search</button>
							</div>
					<!--	<input type="Submit" name="login" class="btn btn-warning" Value="LOGIN">    -->
							
                    </form>
				
                </div>
            </div>
    </div>
    
    


    <?php
if($result_month == true)
{
?>	
   <section class="content" style="padding: 0;">
	<!-- Default box -->
	<div class="container-fluid">
		<div class="card">
			<div class="card-header">
				<div class="card-tools">
				
					<div class="input-group-append center">
						<h2 class="text-center">Result of <?=date("F",mktime(0,0,0,$month_s,10))?>, <?=$year_s?></h2>
					</div>
				
			</div>
		</div>
		<div class="card-body table-responsive p-0">						
    	<table class="table table-dark table-bordered table-striped text-center" style="font-weight: bold;">
		<thead  style="background-color: red">
            <tr>
               	<th>Date/Game</th>
            <?php	
					$i = 0;
					while($i < $ctr)
					{	
			?>
                   		<th><?=$items[$i]?></th>
			<?php
						$i++;
                  	}
			?>
            </tr>
		</thead>
		<tbody>
			<?php
				$d = 1;
//				echo "searchdate".$cds;
				while($d <= $cds)
				{	
					$i = 0;
			?>
					<tr>
					<td style="color: #ff0000;"><?=date("d/m/Y",mktime(0,0,0,$month_s,$d,$year_s))?></td>
			<?php
					while($i < $ctr)
					{	
						$j = 0;
						$sql3 = "select * from result where gamename = '$items[$i]' and year(dt) = '$year_s' and month(dt) = '$month_s' and day(dt) = '$d'";	//where enable = 1
						$r3 = mysqli_query($link,$sql3);
						$result001 = $link->query($sql3);
						if ($result001->num_rows > 0) 
						{
							while($arr = mysqli_fetch_assoc($r3))
							{	$results[$i][$d][$j] = $arr['result'];
			?>					
								<td><?=sprintf('%02d', $results[$i][$d][$j])?></td>
			<?php									
							}
						}
						else
						{
			?>
							<td>**</td>
			<?php
						}
						$i++;
					}
					$d++;
			?>
					</tr>		
			<?php
				};
			?>
		</tbody>
	    </table>
	    </div>
    </div>
</section>


   
<?php
}
?>


