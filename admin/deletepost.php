<?php
include("database.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['ids'])) {
        $ids = $_POST['ids'];
        $ids_str = implode(',', array_map('intval', $ids)); // Sanitize IDs
        $query = "DELETE FROM `post_` WHERE `id` IN ($ids_str)";
        if (mysqli_query($link, $query)) {
            $message = 'Selected posts have been deleted successfully.';
        } else {
            $message = 'Error deleting selected posts.';
        }
    } else {
        $message = 'No posts selected for deletion.';
    }
    header("location:post.php?msg=" . urlencode($message));
    exit;
}
?>
<?php
	
	include("database.php");
	$did=$_GET['delid'];
	$result = mysqli_query($link,"delete from post_ where id='$did'");
	$message = "Post Delete Successfully";
	header("location:post.php?msg=$message");
	exit;
?>