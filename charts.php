<div class="text-center p-3" <h2 style="background: black; border-top: solid 3px red; color: red; font-size: 20px;"><b>GALI2 Results of <?php echo date("F d, Y"); ?> &amp; <?php echo date('F d, Y',strtotime("-1 days")); ?></b></h2></div>
    <div class="col-lg-8 col-md-10 col-12 mx-auto table-responsive">
	<table class="table table-bordered text-center">
		<thead class="table-dark">
			<tr class="text-danger">
				<th style="width: 50%;">Company Name</th>
				<th style="width: 10%; white-space:nowrap">Result Time</th>
			<?php
			    $month = date("m");
				$date = date("d"); // Today's date
				$year = date("Y"); 
				$d = date('d', mktime(0,0,0,$month,($date-1),$year)); 
				$m = date('m', mktime(0,0,0,$month,($date-1),$year)); 
				$y = date('Y', mktime(0,0,0,$month,($date-1),$year)); 
				$d1 = date('d', mktime(0,0,0,$month,($date),$year)); 
				$m1 = date('m', mktime(0,0,0,$month,($date),$year)); 
				$y1 = date('Y', mktime(0,0,0,$month,($date),$year)); 
					
			?>
				<th><?php echo date("D. jS",strtotime("-1 days")); ?></th>
				<th><?php echo date("D. jS");?></th>
			</tr>
		</thead>
            <tbody class="table-dark text-primary">
			<?php
				$sql99 = "SELECT DISTINCT result.gamename, game.tm FROM result , game where result.gamename = game.gamename order by tm";
				$r99 = mysqli_query($link,$sql99);
				while($ar99 = mysqli_fetch_assoc($r99))
				{
					$gm = $ar99['gamename'];
			?>
				<tr>
					<td style="font-weight: bold; font-size: 1rem;"><?=$gm?></td>
					<td style="font-weight: bold;"><?php echo date('h:i A', strtotime($ar99['tm']))?></td>
				<?php
					$month = date("m");
					$date = date("d"); // Today's date
					$year = date("Y"); 
					$d = date('d', mktime(0,0,0,$month,($date-1),$year)); 
					$m = date('m', mktime(0,0,0,$month,($date-1),$year)); 
					$y = date('Y', mktime(0,0,0,$month,($date-1),$year)); 
					$sql98 = "select * from result where gamename = '$gm' and year(dt) = '$y' and month(dt) = '$m' and day(dt) = '$d' LIMIT 1";	//where enable = 1
					$r98 = mysqli_query($link,$sql98);
					if ($r98->num_rows > 0) 
					{
						while($ar98 = mysqli_fetch_assoc($r98))
						{
				?>
							<td class="" style="font-weight: bold; font-size: 1.3rem; color: #3498DB;"><?=sprintf('%02d', $ar98['result'])?></td>
				<?php
						}
					}
					else
					{
				?>
						<td>**</td>
				<?php
					}
				?>
				<?php
					$d1 = date('d', mktime(0,0,0,$month,($date),$year)); 
					$m1 = date('m', mktime(0,0,0,$month,($date),$year)); 
					$y1 = date('Y', mktime(0,0,0,$month,($date),$year)); 
					$sql97 = "select * from result where gamename = '$gm' and year(dt) = '$y1' and month(dt) = '$m1' and day(dt) = '$d1' LIMIT 1";	//where enable = 1
					$r97 = mysqli_query($link,$sql97);
					if ($r97->num_rows > 0) 
					{
						while($ar97 = mysqli_fetch_assoc($r97))
						{
				?>
							<td class="" style="font-weight: bold; font-size: 1.5rem; color: #DB3434;"><?=sprintf('%02d', $ar97['result'])?></td>
				<?php
						}
					}
					else
					{
				?>
						<td>**</td>
				<?php
					}
				?>
					
			</tr>
			
			<?php
				}
			?>
		</tbody>
	</table>
	
   </div>