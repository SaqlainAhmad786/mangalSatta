<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("admin/database.php");
include("forum-smiles.php"); // Include the replacements file

extract($_POST);

if (isset($post)) {
    $err = "";
    $pass = false;
    if (isset($_SESSION['designation'])) {
        $pass = true;
        $desig = $_SESSION['designation'];
        $un = '';
        if (isset($_SESSION['username'])) {
            $un = $_SESSION['username'];
        } elseif (isset($_SESSION['adminname'])) {
            $un = $_SESSION['adminname'];
        } elseif (isset($_SESSION['gadminname'])) {
            $un = $_SESSION['gadminname'];
        }
        if ($un) {
            $r = mysqli_query($link, "SELECT * FROM user WHERE username='$un' OR mobile='$un'");
            $ar = mysqli_fetch_assoc($r);
            if (!empty($ar['image'])) {
                $_SESSION['image'] = "user_images/" . $ar['image'];
            } else {
                $_SESSION['image'] = "user_images/img_avatar.png"; // default image
            }

            $post_text = nl2br(htmlspecialchars(trim($post_text)));
            $sql = "INSERT INTO post_(name, designation, post, replyid) VALUES ('$un', '$desig', '$post_text', '$reply')";
            if (mysqli_query($link, $sql)) {
                header("location:posting.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($link);
            }
        }
    } else {
        header("location:login.php");
        $err = "Login to post..";
    }
}
$limit = 10; // Number of posts per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$totalPostsSql = "SELECT COUNT(*) FROM post_";
$totalPostsResult = mysqli_query($link, $totalPostsSql);
$totalPostsRow = mysqli_fetch_array($totalPostsResult);
$totalPosts = $totalPostsRow[0];
$totalPages = ceil($totalPosts / $limit);
// Join query to fetch posts along with user information
$result = mysqli_query($link, "SELECT post_.id as post_id, post_.name as post_name, post_.designation, post_.post, post_.replyid, post_.date as post_date, user.name as user_name, user.image 
                               FROM post_ 
                               LEFT JOIN user ON post_.name = user.name 
                               ORDER BY post_.date DESC 
                               LIMIT $offset, $limit");
?>

<?php define('MyConst', TRUE); ?>
<?php include("headerpost.php") ?>
<body>
    <?php include("nav.php") ?>
    <?php include("include/posttop.php") ?>
    <div class="alert alert-danger text-center shadow m-2 rounded">
        <div class="row">
            <div class="col-md-8 mx-auto wow fadeInUp">
                <form name="sentMessage" method="post">
                    <div class="text-center text-dark pb-2"><b>Enter Your Guess!</b></div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <textarea placeholder="Post Here.." class="form-control" name="post_text" id="post_text" required data-validation-required-message="Please type in textbox." style="height: 100px; text-align: center;"></textarea>
                            <p class="help-block">
                                <?php
                                if (isset($err)) {
                                    echo "<label style='color:red;'>$err</label>";
                                }
                                ?>
                            </p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger" name="post">Post Submit</button>
                </form>
            </div>
        </div>
    </div>
    <br>
   <section class="features-mid-block" id="features-mid">
<?php
while ($arr = mysqli_fetch_assoc($result)) {
    $ri = $arr['replyid'];
?>
    <div class="">
        <div class="alert alert-danger text-center shadow rounded m-2">
            <center>
                <?php
                    if (!empty($arr['image'])) {
                ?>
                <!-- <img class="rounded-circle" src="user_images/<?= $arr['image'] ?>" width="70" height="70"> -->
                <?php
                    } else {
                ?>
                    <img class="rounded-circle" src="user_images/img_avatar.png" width="70" height="70">
                <?php
                    }
                ?>
                <h3 class="font-weight-bold"><?= $arr['post_name'] ?></h3>
                <span class="text-dark pb-2" style="font-size: 16px;"><?= $arr['designation'] ?></span> 
                <br/>
                <b class="text-primary"><?= date('d M Y, h:i A', strtotime($arr['post_date'])) ?></b>
            </center>
            <div class="card card-body bg-light">
            <div style="font-weight: 500;"> <b><?= applyReplacements($arr['post']) ?></b>
            </div>
            
            <?php
            do {
                if ($ri) {
                    $r1 = mysqli_query($link, "SELECT * FROM post_ WHERE id = '$ri'");
                    $arr1 = mysqli_fetch_assoc($r1);
            ?>
                    
                        
                            <b class="text-center">
                                <?php
                                if($arr1['replyid']) {
                                ?>
                        <hr/>Replied by: <?= $arr1['name'] ?><br/>
                                 <span class="text-center"> <?= applyReplacements($arr1['post']) ?></span>
                                <?php
                                } else {
                                ?><hr/><font color="red">Originally Posted by: <?= $arr1['name'] ?><br/>
                                 <span class="text-center"> <?= applyReplacements($arr1['post']) ?></span></font>
                                
                                <?php
                                }
                                ?>
                                
                            </b>
                           
                        
                    
            <?php
                    $ri = $arr1['replyid'];
                }
            } while ($ri);
            ?></div>
            <center>
                <a href="posting.php"><button type="button" class="btn btn-outline-danger btn-sm" style="margin-top: 10px; margin-right:50px;">Refresh Post</button></a>
                <?php
                if (!empty($un) && !empty($um)) {
                ?>
                    <a href="post.php?id=<?= $arr['post_id'] ?>&&desig=<?= $desig ?>&&un=<?= $_SESSION['username'] ?>"><button type="button" class="btn btn-outline-success btn-sm" style="margin-top: 10px;">Reply Post</button></a>
                <?php
                } else if ($_SESSION['adminname'] && $_SESSION['adminemail']) {
                ?>
                    <a href="post.php?id=<?= $arr['post_id'] ?>&&desig=<?= $desig ?>&&un=<?= $_SESSION['adminname'] ?>"><button type="button" class="btn btn-outline-success btn-sm" style="margin-top: 10px;">Reply Post</button></a>
                <?php
                } else if ($_SESSION['gadminname'] && $_SESSION['gadminemail']) {
                ?>
                    <a href="post.php?id=<?= $arr['post_id'] ?>&&desig=<?= $desig ?>&&un=<?= $_SESSION['gadminname'] ?>"><button type="button" class="btn btn-outline-success btn-sm" style="margin-top: 10px;">Reply Post</button></a>
                <?php
                } else {
                    $msg = "Login to Reply!";
                ?>
                    <a href="login.php?msg=<?= $msg ?>"><button type="button" class="btn btn-outline-success btn-sm" style="margin-top: 10px; margin-left:50px;" data-toggle="tooltip" title="Login to Reply!">Reply Post</button></a>
                <?php
                }
                ?>
            </center>
        </div>
    </div>
<?php
}
?>


    <div class="d-flex justify-content-center">
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a href="?page=<?= $page - 1 ?>" class="page-link">Previous</a>
            </li>
        <?php endif; ?>
        
        <?php
        // Determine the start and end page
        if ($page <= 3) {
            $startPage = 1;
            $endPage = min(5, $totalPages);
        } else {
            $startPage = $page - 2;
            $endPage = min($startPage + 4, $totalPages);
        }

        // Adjust startPage if we are near the end of the pages
        if ($endPage - $startPage < 4) {
            $startPage = max(1, $endPage - 4);
        }

        // Display page numbers
        for ($i = $startPage; $i <= $endPage; $i++): 
        ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a href="?page=<?= $i ?>" class="page-link"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a href="?page=<?= $page + 1 ?>" class="page-link">Next</a>
            </li>
        <?php endif; ?>
    </ul>
</div>
</section>
<?php include("footer.php") ?>
