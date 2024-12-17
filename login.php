<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    define('MyConst', TRUE);
    if(!empty($_SESSION['username']) && !empty($_SESSION['usermobile'])) {
        header("location:index.php");
        exit(); // Ensure script stops here to avoid any further execution
    } 
?>
<?php
    include("admin/database.php");
    extract($_POST);
    if(isset($login)) {
        $un = trim($un);
        $password = trim($password);
        $error = "";
        $un_valid = $pass_valid = false;
        
        // username/mobile validation
        if(empty($un)) {
            $error .= "Enter Valid Username/Mobile<br>";
        } else {
            $result = mysqli_query($link,"select * from user where username='$un' OR mobile='$un'");
            if(mysqli_num_rows($result) > 0) {
                $un_valid = true;
            } else {
                $error .= "Username/Mobile Not Exist<br>";
            }
        }

        // password validation
        if(empty($password)) {
            $error .= "Enter Password<br>";
        } else {
            $pass_valid = true;
        }

        if($un_valid && $pass_valid) {
            $result = mysqli_query($link,"SELECT * FROM user WHERE username='$un' OR mobile='$un'");
            $arr = mysqli_fetch_assoc($result);
            if(md5($password) == $arr['password']) {    
                session_unset();
                if($arr['approve']==1)
                {   
                    if($arr['profile'])
                    {
                        $_SESSION['designation'] = $arr['profile'];
                    }
                    else
                    {
                        $_SESSION['designation'] = "Member";
                    }
                    $_SESSION['username'] = $arr['name'];
                    $_SESSION['usermobile'] = $arr['mobile'];
                    if(!empty($image)) {
                        $_SESSION['image'] = "user_images/".$arr['image'];
                    }
                    // Redirect to home page
                    header("Location: posting.php");
                    exit(); // Ensure script stops here to avoid any further execution
                }
                else
                {   
                    echo "<script>alert('User account inactive. Contact administrator!');</script>"; 
                    $error .= "User account inactive. Contact administrator!<br>";
                }
                
            } else {
                $error .= "Invalid Password<br>";
            }
        }
    }
    if(!empty($_GET['msg'])) {
        $msg = $_GET['msg'];
    }
?>
<?php include("header.php");?>

<body id="page-top" data-gr-c-s-loaded="true">
    <header class="bg-warning text-white">
        <?php include("nav.php");?>

        <section class="trial-block" id="trial">
            <div class="container">
                <div class="section-title pb-3 text-center">
                    <!-- <span class="badge badge-info">Get Started</span> -->
                    <?php if(!empty($msg)): ?>
                        <h2 class="text-danger"><?= $msg ?></h2>
                    <?php else: ?>
                        <h2 style="font-weight: 700">LOGIN</h2>
                    <?php endif; ?>
                    <?php if(!empty($error)): ?>
                        <span class="text-light bg-primary"><?= $error ?></span>
                    <?php endif; ?>
                    <!-- STATUS -->
                    <?php if(!empty($_SESSION['status'])): ?>
                        <label class="alert-success"><?= $_SESSION['status'] ?></label>
                        <?php unset($_SESSION['status']); ?>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-12 mx-auto wow fadeInUp">
                        <form name="sentMessage" method="post">
                            <div class="control-group form-group">
                                <div class="controls">
                                    <input type="text" placeholder="Mobile Number" class="form-control" name="un" id="un" required="" data-validation-required-message="Please enter Username/Mobile Number." style="border-radius: 6px;">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group form-group wow fadeInUp">
                                <div class="controls">
                                    <div class="input-group">
                                        <input type="password" placeholder="Password" class="form-control" name="password" id="password" required="" data-validation-required-message="Please enter Password." style="border-top-left-radius: 6px; border-bottom-left-radius: 6px;">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div id="success"></div>
                            <!-- For success/fail messages -->
                             <div class="text-center">
                                 <button type="submit" class="btn btn-lg rounded-sm" name="login">Login</button>
                                </div>
                            <!-- <input type="Submit" name="login" class="btn btn-warning" Value="LOGIN"> -->
                        </form>
                        <br>
                        <center>
                            <h6 class="text-body m-0">Don't have Account! <a href="registration.php" class="text-primary">Register Here</a></h6>
                        </center>
                    </div>
                </div>
            </div>
        </section>

    <?php include("footer.php");?>

<script>
    // Password toggle
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
