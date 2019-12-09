<?php  
    include "includes/db.php"; 
    include "includes/header.php"; 
    //from PHPmailer guide it's the setup
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require_once "vendor/autoload.php";
    require_once "classes/config.php";

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //checking forgot id is present in url to block someone from directly accessing page
    if (!$_GET['forgot']) {
        header("Location: index.php");
    }

    if (isset($_POST['recover-submit'])) {
        if (isset($_POST['email'])) {
            $email = htmlentities($_POST['email']);
           
            $query = "SELECT user_email FROM users WHERE user_email = :em";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(':em' => $email));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row !== false) {
                //generating unique token for email reset request
                $length = 50;
                $token = bin2hex(openssl_random_pseudo_bytes($length));

                $query = "UPDATE users SET token = :tok WHERE user_email = :em";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array(
                    ':tok' => $token,
                    ':em' => $email));

                //configuring PHP Mailer
                $mail = new PHPMailer(true);
                
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = Config::SMTP_HOST;                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = Config::SMTP_USER;                     // SMTP username
                $mail->Password   = Config::SMTP_PASSWORD;                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = Config::SMTP_PORT;                                    // TCP port to connect to
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';

                $mail->setFrom('testsender@test.com');
                $mail->addAddress($email);
                $mail->Subject = "Password Reset";
                $mail->Body = '<p>Please click here to reset your password.
                                <a href="http://localhost:8888/php_practice/udemy_cms_course/cms/reset.php?email='.$email.'&token='.$token.'">RESET</a>
                                </p>';

                if ($mail->send()) {
                    $_SESSION['success'] = "Please check your email inbox";
                    header("Location: forgot.php?forgot=1");
                    return;
                } else {
                    $_SESSION['error'] = "Mail failed to send please try again";
                    header("Location: forgot.php?forgot=1");
                    return;
                }

            } else {
                $_SESSION['error'] = "Provided email does not match any in system";
                header("Location: forgot.php?forgot=1");
                return;
            }
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
                                <h2 class="text-center">Forgot Password?</h2>
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



                                    <form action="" id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
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

