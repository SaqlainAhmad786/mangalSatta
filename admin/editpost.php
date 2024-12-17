<?php
session_start();
include("database.php");

if (empty($_SESSION['adminname'])) {
    header("location:index.php");
    exit;
}

$post_id = $_GET['id'];
$post_data = mysqli_query($link, "SELECT * FROM post_ WHERE id='$post_id'");
$post = mysqli_fetch_assoc($post_data);

// Decode HTML entities and replace <br> tags with new line characters for display in the textarea
$display_post_text = htmlspecialchars_decode($post['post']);
$display_post_text = str_replace(array('<br>', '<br/>', '<br />'), "\n", $display_post_text);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_text = htmlspecialchars(trim($_POST['post_text']));
    // Convert new line characters to <br> tags before saving to the database
    $post_text_db = str_replace("\n", '<br>', $post_text);
    $sql = "UPDATE post_ SET post='$post_text_db' WHERE id='$post_id'";
    if (mysqli_query($link, $sql)) {
        $_SESSION['status'] = "Post updated successfully.";
        header("location:post.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <?php include("nav1.php"); ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php include("mainsidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Post</h1>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Post</h3>
                    </div>
                    <form method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="post_text">Post Text</label>
                                <textarea name="post_text" id="post_text" class="form-control" rows="5" required><?= htmlspecialchars($display_post_text) ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("footer.php"); ?>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Post</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/custom.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <?php include("nav1.php"); ?>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <?php include("mainsidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid my-2">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Post</h1>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Post</h3>
                    </div>
                    <form method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="post_text">Post Text</label>
                                <textarea name="post_text" id="post_text" class="form-control" rows="5" required><?= $post['post'] ?></textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("footer.php"); ?>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>
</body>
</html>