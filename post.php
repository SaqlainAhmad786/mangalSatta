<?php
session_start();

if(isset($_SESSION['username']) || isset($_SESSION['adminname']) || isset($_SESSION['gadminname'])) {
    if(isset($_SESSION['username'])) {
        $un = $_SESSION['username'];
        $um = $_SESSION['usermobile'];
    } elseif(isset($_SESSION['adminname'])) {
        $un = $_SESSION['adminname'];
        $um = ''; // Admin might not have a mobile session variable
    } elseif(isset($_SESSION['gadminname'])) {
        $un = $_SESSION['gadminname'];
        $um = ''; // Super admin might not have a mobile session variable
    }
    $desig = $_SESSION['designation'];
} else {
    header("location:index.php");
    exit;
}

if(!isset($_GET['id']) || !isset($_GET['un']) || !isset($_GET['desig'])) {
    header("location:index.php");
    exit;
}

define('MyConst', TRUE);
include("admin/database.php");
//$passZ = 0;
$id = $_GET['id'];
$desig = $_SESSION['designation'];
/*
if(($desig=="Site Owner")||($desig=="Admin"))
{
    $passZ = 1;
}
if($passZ==0)
{
    $result1 = mysqli_query($link,"select * from user where username='$mobile' limit 1");
	$arr1 = mysqli_fetch_assoc($result1);
	$approve = $arr1['approve'];
}
*/
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['replysubmit'])) 
{
    $reply =nl2br(htmlspecialchars(trim($_POST['reply'])));
    $sql = "INSERT INTO post_(name, designation, post, replyid) VALUES ('$un', '$desig', '$reply', '$id')";
    if (mysqli_query($link, $sql)) {
        header("location:posting.php");
        exit;
    }
}
else
{
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
}

$originalPostSql = "SELECT * FROM post_ WHERE id = '$id'";
$originalPostResult = mysqli_query($link, $originalPostSql);
$originalPost = mysqli_fetch_assoc($originalPostResult);

$repliesSql = "SELECT * FROM post_ WHERE replyid = '$id'";
$repliesResult = mysqli_query($link, $repliesSql);
?>

<?php include("header.php"); ?>

<body id="page-top" data-gr-c-s-loaded="true">
    <header class="bg-warning text-white">
        
        <?php include("nav.php");?>

    <section class="trial-block" id="trial">
        
        <div class="container bg-warning">
            <div class="section-title pb-3 text-center">
                <span class="badge badge-info">Get Started</span>
                <h2>Reply Post</h2>
            </div>
            <!--<div class="row">-->
            <!--    <div class="col-md-8 mx-auto wow fadeInUp">-->
            <!--        <div class="original-post">-->
            <!--            <h3>Original Post</h3>-->
            <!--            <p><strong>Posted by:</strong> <?php echo htmlspecialchars($originalPost['name']); ?></p>-->
            <!--            <p><strong>Designation:</strong> <?php echo htmlspecialchars($originalPost['designation']); ?></p>-->
            <!--            <p><?php echo nl2br(htmlspecialchars($originalPost['post'])); ?></p>-->
            <!--        </div>-->

                    <form name="sentMessage" method="post">
                        <div class="control-group form-group">
                            <div class="controls">
                                <textarea placeholder="Reply" class="form-control" rows="5" name="reply" id="reply" required data-validation-required-message="Please enter reply." style="text-align: center;"></textarea>
                            </div>
                        </div>
                        
                        <div id="success"></div>
                        <button type="submit" class="btn btn-warning btn-lg btn-block" name="replysubmit">Submit</button>
                        <a href="index.php" class="btn btn-info btn-lg btn-block">Home</a>
                    </form>

                    <!--<div class="replies">-->
                    <!--    <h3>Replies</h3>-->
                    <!--    <?php while($reply = mysqli_fetch_assoc($repliesResult)): ?>-->
                    <!--        <div class="reply">-->
                    <!--            <p><strong>Reply by:</strong> <?php echo htmlspecialchars($reply['name']); ?></p>-->
                    <!--            <p><strong>Designation:</strong> <?php echo htmlspecialchars($reply['designation']); ?></p>-->
                    <!--            <p><?php echo nl2br(htmlspecialchars($reply['post'])); ?></p>-->
                    <!--        </div>-->
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>

