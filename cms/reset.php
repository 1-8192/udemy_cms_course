<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // blocking accessing page w/o required parameters
    if (!isset($_GET['email']) || !isset($_GET['token'])) {
        header("Location: index");
    } else {
        $email = $_GET['email'];
        $token = $_GET['token'];
    }

    if (isset($_POST['recover-submit'])) {
        if (!isset($_POST['password']) || !isset($_POST['confirm-password'])) {
            $_SESSION['error'] = "Fields cannot be empty";
            header("Location: reset.php?email='.$email.'&token='.$token.'");
            return;
        }
        if ($_POST['password'] !== $_POST['confirm-password']) {
            $_SESSION['error'] = "Passwords do not match";
            header("Location: reset.php?email='.$email.'&token='.$token.'");
            return;
        } else {
            $password = crypt($_POST['password'], '$2a$07$YourSaltIsA22ChrString$');

            $query = "UPDATE users SET user_password = :pass WHERE token = :tok";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
                ':pass' => $password,
                ':tok' => $token
            ));

            $_SESSION['success'] = "Password Updated";
            header("Location: admin/index.php");
            return;
            
        }
    }

?>
<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">
                                <?php 
                                    if (isset($_SESSION['error'])) {
                                        $message = $_SESSION['error'];
                                        echo '<p class="text-center" style="color:red">'."$message".'</p>';
                                        unset($_SESSION['error']);
                                    }

                                    if (isset($_SESSION['success'])) {
                                        $message = $_SESSION['success'];
                                        echo '<p class="text-center" style="color:green">'."$message".'</p>';
                                        unset($_SESSION['success']);
                                    }
							    ?>
                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input id="password" name="password" placeholder="new password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                                <input id="confirm-password" name="confirm-password" placeholder="confirm password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

