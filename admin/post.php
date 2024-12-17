<?php
include("database.php");

session_start();
$aname = $_SESSION['adminname'];
$aemail = $_SESSION['adminemail'];

if (empty($aname)) {
    // if user is not logged in
    header("location:index.php");
    exit;
}

// Pagination settings
$default_records_per_page = 30; // Default number of records to display per page
$records_per_page = isset($_GET['records']) && is_numeric($_GET['records']) ? (int)$_GET['records'] : $default_records_per_page;
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($current_page - 1) * $records_per_page;

// Search functionality
$search_query = isset($_GET['q']) ? $_GET['q'] : '';
$search_condition = !empty($search_query) ? "WHERE (post LIKE '%$search_query%' OR name LIKE '%$search_query%')" : '';

// Fetch records with pagination and search
$query = "SELECT * FROM `post_` $search_condition ORDER BY `date` DESC LIMIT $start_from, $records_per_page";
$result = mysqli_query($link, $query);

// Calculate total number of pages for pagination
$total_pages_query = "SELECT COUNT(*) AS total FROM `post_` $search_condition";
$total_pages_result = mysqli_query($link, $total_pages_query);
$total_pages_row = mysqli_fetch_assoc($total_pages_result);
$total_pages = ceil($total_pages_row['total'] / $records_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GALI2 :: Administrative Panel</title>
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
                        <h1>Posts</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="create-post.php" class="btn btn-primary">Create New Post</a>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <?php
            // success message
            if (!empty($_SESSION['status'])) {
                echo '<label class="alert-success">' . $_SESSION['status'] . '</label>';
                unset($_SESSION['status']);
            }

            // delete category message
            if (!empty($_GET['msg'])) {
                echo '<label class="alert-info">' . $_GET['msg'] . '</label>';
            }
            ?>

            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <form action="" method="get">
                                <div class="input-group" style="width: 350px;">
                                    <input type="text" name="q" class="form-control float-right" placeholder="Search" value="<?= $search_query ?>">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <div class="input-group-append">
                                         <span class="input-group-text" style="font-weight: bold;">Filter</span>
                                        <select name="records" class="form-control" onchange="this.form.submit()">
                                            <option value="30" <?= $records_per_page == 30 ? 'selected' : '' ?>>30</option>
                                            <option value="100" <?= $records_per_page == 100 ? 'selected' : '' ?>>100</option>
                                            <option value="500" <?= $records_per_page == 500 ? 'selected' : '' ?>>500</option>
                                            <option value="1000" <?= $records_per_page == 1000 ? 'selected' : '' ?>>1000</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <form id="delete-form" action="deletepost.php" method="post" onsubmit="return confirm('Are you sure you want to delete selected posts?');">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>ID</th>
                                    <th>Post</th>
                                    <th>Posted By</th>
                                    <th>Designation</th>
                                    <th>Date/Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $ctr = ($current_page - 1) * $records_per_page + 1;
                                while ($arr = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" value="<?= $arr['id'] ?>"></td>
                                        <td><?= $ctr ?></td>
                                        <td><a href="reply.php?id=<?= $arr['id'] ?>"><?= $arr['post'] ?></a></td>
                                        <td><?= $arr['name'] ?></td>
                                        <td><?= $arr['designation'] ?></td>
                                        <td><?= $arr['date'] ?></td>
                                        <td>
                                            <a href="editpost.php?id=<?= $arr['id'] ?>" class="text-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="deletepost.php?delid=<?= $arr['id'] ?>" class="text-danger" onclick="return checkDelete()">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                    $ctr++;
                                }
                                ?>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    <!-- Pagination -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <?php if ($current_page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $current_page - 1 ?>&q=<?= $search_query ?>&records=<?= $records_per_page ?>">Previous</a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <li class="page-item<?= ($current_page == $i) ? ' active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?>&q=<?= $search_query ?>&records=<?= $records_per_page ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($current_page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?= $current_page + 1 ?>&q=<?= $search_query ?>&records=<?= $records_per_page ?>">Next</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("footer.php"); ?>
</div>
<!-- ./wrapper -->
<!-- jQuery -->
	<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap 4 -->
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="js/adminlte.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="js/demo.js"></script>
<script>
    // Select/Deselect all checkboxes
    document.getElementById('select-all').onclick = function() {
        var checkboxes = document.getElementsByName('ids[]');
        for (var checkbox of checkboxes) {
            checkbox.checked = this.checked;
        }
    }

    function checkDelete() {
        return confirm('Are you sure you want to delete this post?');
    }
</script>
</body>
</html>
