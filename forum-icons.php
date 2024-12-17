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

<body>

<?php include("nav.php")?>

<style type="text/css">
    table {
        width: 100%;
    }
    table thead {
        background: #333;
        color: #fff;
    }
    table thead th {
        padding: 8px;
    }
    table td h2 {
        font-weight: bold;
        font-size: 18px;
    }
</style>
<div class="card card-body m-2">
    <div class="justify-content-center text-center">
        <h1 class="font-weight-bold">Forum icons</h1>
        <p>Forum icons for guessing use this code for copy and past guessing posting page.</p>
      
        <table class="table-bordered table-striped">
            <thead class="">
                <tr>
                <th>Simles</th>
                <th>Code</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                <td><img src="smiles/mangal-sattaking.png" width='180' alt="icons"></td>
                <td><h2>.logo.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/frbd.png" alt="icons"></td>
                <td><h2>.frbd.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/gzbd.png" alt="icons"></td>
                <td><h2>.gzbd.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/gali1.png" alt="icons"></td>
                <td><h2>.gali.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/dswr.png" alt="icons"></td>
                <td><h2>.dswr.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/mangal-murti.png" width='190' alt="icons"></td>
                <td><h2>.mm.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/dl-bazaar.png" width='200' alt="icons"></td>
                <td><h2>.db.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/shree-ganesh.png" width='180' alt="icons"></td>
                <td><h2>.sg.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/faridabad.png" width='190' alt="icons"></td>
                <td><h2>.fd.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/ghaziabad.png" width='200' alt="icons"></td>
                <td><h2>.gd.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/gali.png" width='140' alt="icons"></td>
                <td><h2>.gl.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/desawar.png" width='180' alt="icons"></td>
                <td><h2>.ds.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/single.png" width='160' alt="icons"></td>
                <td><h2>.single.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/haruf.png" width='150' alt="icons"></td>
                <td><h2>.haruf.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/ander.png" width='130' alt="icons"></td>
                <td><h2>.ander.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/baher.png" width='130' alt="icons"></td>
                <td><h2>.baher.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/result.png" width='160' alt="icons"></td>
                <td><h2>.result.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/pass.png" width='140' alt="icons"></td>
                <td><h2>.ps.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/a.gif" alt="icons"></td>
                <td><h2>.a.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/b.gif" alt="icons"></td>
                <td><h2>.b.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/0.gif" alt="icons"></td>
                <td><h2>.0.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/1.gif" alt="icons"></td>
                <td><h2>.1.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/2.gif" alt="icons"></td>
                <td><h2>.2.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/3.gif" alt="icons"></td>
                <td><h2>.3.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/4.gif" alt="icons"></td>
                <td><h2>.4.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/5.gif" alt="icons"></td>
                <td><h2>.5.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/6.gif" alt="icons"></td>
                <td><h2>.6.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/7.gif" alt="icons"></td>
                <td><h2>.7.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/8.gif" alt="icons"></td>
                <td><h2>.8.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/9.gif" alt="icons"></td>
                <td><h2>.9.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/5star.png" width='100' alt="icons"></td>
                <td><h2>.5star.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/baaz.png" alt="icons"></td>
                <td><h2>.baaz.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/boom.gif" alt="icons"></td>
                <td><h2>.boom.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/hi.gif" alt="icons"></td>
                <td><h2>.hi.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/jhula.gif" alt="icons"></td>
                <td><h2>.jhula.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/rose.gif" alt="icons"></td>
                <td><h2>.rose.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/star.gif" alt="icons"></td>
                <td><h2>.*.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/thanks.png" width='100' alt="icons"></td>
                <td><h2>.thanks.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/thankyou.gif" alt="icons"></td>
                <td><h2>.thankyou.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/winner.png" width='90' alt="icons"></td>
                <td><h2>.winner.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/xx.gif" alt="icons"></td>
                <td><h2>.xx.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/dhamaka.png" width='100' alt="icons"></td>
                <td><h2>.dhamaka.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/congratulation.gif" alt="icons"></td>
                <td><h2>.cong1.</h2></td>
                </tr>
                <tr>
                <td><img src="smiles/congrats.gif" width='80' alt="icons"></td>
                <td><h2>.cong.</h2></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</div>

<?php include("footer.php")?>