<?php
    if(isset($_SESSION['username']) && isset($_SESSION['usermobile'])) {
        $un = $_SESSION['username'];
        $um = $_SESSION['usermobile'];
    }
    if(isset($_SESSION['adminname']) && isset($_SESSION['adminemail'])) {
        $an = $_SESSION['adminname'];
        $ae = $_SESSION['adminemail'];
    }
    if(isset($_SESSION['gadminname']) && isset($_SESSION['gadminemail'])) {
        $gan = $_SESSION['gadminname'];
        $gae = $_SESSION['gadminemail'];
    }
?>

<nav class="navbar navbar-expand-sm navbar-light bg-dark">
    <a class="navbar-brand" href="/"><img src="images/logo-vector.svg" width="80" class="" alt="satta king 786"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto" style="font-size: 14px; gap: 10px; text-transform: uppercase; font-weight: 500;">
            <li class="nav-item">
                <a class="nav-link" style="color: orange" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: orange" href="/online-play.php">Play Online</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: orange" href="/record-chart.php">Record Chart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color: orange" href="posting.php">Posting</a>
            </li>
            <li class="nav-item">   
                <?php if(empty($gan)): ?>
                    <a class="nav-link" style="color: orange" href="/admin/index2.php">Admin</a>
                <?php else: ?>
                    <a class="nav-link text-danger" href="/admin/index2.php">Admin : Logged in as: <?=$gan?>/<?=$_SESSION['designation']?></a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <?php if(empty($um)): ?>
                    <a class="nav-link" style="color: orange" href="/login.php">User</a>
                <?php else: ?>
                    <a class="nav-link text-danger" href="/profile.php">Welcome: <?=$un?></a>
                <?php endif; ?>
            </li>
            <?php if(isset($um)): ?>
                <li class="nav-item">
                    <div class="alert alert-info">
 		<a href="/profile.php?logout=yes" class="link">Logout</a>
	    </div>
                </li>
            <?php endif; ?>
        </ul>
        <div class="d-inline my-2 my-lg-0">
            <?php if(empty($um)): ?>
                <a class="btn btn-outline-danger my-2 my-sm-0" style="border-radius: 6px; color: orange; border-color: orange;" href="/login.php" role="button">Login</a>
                <a class="btn btn-outline-danger ml-2 my-2 my-sm-0" style="border-radius: 6px; color: orange; border-color: orange;" href="/registration.php" role="button">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>  
