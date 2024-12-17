
			
<div id="board-chart">
    <table class="quick-result-board">
            <tbody><tr class="board-title">
                <th colspan="3">
                    <h2>GALI2 Results of February 27, 2024 &amp; February 26, 2024</h2>
                </th>
            </tr>
            <tr class="board-head">
                <th class="games-name">
                    <h2>Games List</h2>
                </th>
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
                <th class="yesterday-date">
                    <h2><?php echo $d."/".$m."/".$y?></h2>
                </th>
                <th class="today-date">
                    <h2><?php echo $d1."/".$m1."/".$y1?></h2>
                </th>
            </tr>
            <?php
				$sql99 = "SELECT DISTINCT result.gamename, game.tm FROM result , game where result.gamename = game.gamename order by tm";
				$r99 = mysqli_query($link,$sql99);
				while($ar99 = mysqli_fetch_assoc($r99))
				{
					$gm = $ar99['gamename'];
			?>
                    <tr class="game-result">
                <td class="game-details">
                    <h3 class="game-name"><?=$gm?></h3>
                    <h3 class="game-time"> at <?php echo date('h:i A', strtotime($ar99['tm']))?></h3>
                    <h3 class="game-link"><a href="#section1">Record Chart</a></h3>
                </td>
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
                <td class="yesterday-number">
                    <h3><?=sprintf('%02d', $ar98['result'])?></h3>
                </td>
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
                <td class="today-number">
                    <h3><?=sprintf('%02d', $ar97['result'])?></h3>
                </td>
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
                    
        </tbody>
    </table>
</div>