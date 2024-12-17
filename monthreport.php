<?php
if(!defined('MyConst')) {
   die('Direct access not permitted');
}
?>

            <section>
					<!-- Default box -->
				<div class="container-fluid">
						<div class="card border-0">
							<div class="card-header">
								<div class="card-tools">
									
									
										<div class="input-group-append text-center">
									<h2 style="font-weight: bold; color: #AF1740">Report 2024 Sattaking </h2>
									</div>
									  
								</div>
							</div>
            <?php
            $sql = "select max(year(dt)) as currentyear from result where enable = 1"; //where enable = 1
        	$r = mysqli_query($link,$sql);
        	$rw = mysqli_fetch_assoc($r);
        	$cy = $rw['currentyear'];
    //    	echo "Current Year:".$cy;
        	
        	$sql1 = "select max(month(dt)) as currentmonth from result where year(dt) = '$cy' and enable = 1";	//where enable = 1
        	$r1 = mysqli_query($link,$sql1);
        	$rw1 = mysqli_fetch_assoc($r1);
        	$cm = $rw1['currentmonth'];
    //  	echo "<br>Current Month:".$cm;
        	
        	$sql2 = "select max(day(dt)) as currentday from result where year(dt) = '$cy' and month(dt) = '$cm' and enable = 1";	//where enable = 1
        	$r2 = mysqli_query($link,$sql2);
        	$rw2 = mysqli_fetch_assoc($r2);
    //    	$cd = $rw2['currentday'];
    //    	echo "<br>Current Day:".$cd;
            $cd = gmdate("j") ;     //current date
			$items = array();
			$count = 0;
            $sql0 = "select DISTINCT gamename from result where enable = 1 ORDER by gamename ASC";	//where enable = 1
            $r0 = mysqli_query($link,$sql0);
            while($arr0 = mysqli_fetch_assoc($r0))
            {
				$items[] = $arr0['gamename'];
				$count++;
            }
			$i = 0;
			while($i < $count)
			{	
				$date = array($items);
				$d = 1;
				while($d <= $cd)
				{	
					$data[$i][$d] = $d;
					$j = 0;
					$results = array($data);
					$sql3 = "select * from result where gamename = '$items[$i]' and year(dt) = '$cy' and month(dt) = '$cm' and day(dt) = '$d'";	//where enable = 1
					$r3 = mysqli_query($link,$sql3);
					while($arr = mysqli_fetch_assoc($r3))
					{	$results[$i][$d][$j] = $arr['result'];
					}
					$d++;
				}
				$i++;
			};
                    
            ?>
			<!-- Display Table:: Results -->
							<div class="card-body table-responsive p-0 text-center">								
								<table class="table table-bordered table-striped text-center" style="font-weight: bold;">
								   
									<thead style="background-color: #D6CFB4">
                                        <tr>
                                        	<th>Date/Game</th>
                                        	<?php	
											$i = 0;
											while($i < $count)
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
										while($d <= $cd)
										{	
											$i = 0;
									?>
											<tr>
											<td style="color: #ff0000;"><?=date("d/m/y",mktime(0,0,0,$cm,$d,$cy))?></td>
									<?php
											while($i < $count)
											{	
												$j = 0;
												$sql3 = "select * from result where gamename = '$items[$i]' and year(dt) = '$cy' and month(dt) = '$cm' and day(dt) = '$d'";	//where enable = 1
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
					</div>
					
				</section>
