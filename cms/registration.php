<?php  
    include "includes/db.php"; 
?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
<?php 
 if (isset($_SESSION['error'])) {
    $message = $_SESSION['error'];
    echo '<p class="text-center" style="color:red">'."$message".'</p>';
    unset($_SESSION['error']);
 }

 if (isset($_POST['submit'])) {
     if (!empty($_POST['user_name']) && !empty($_POST['user_password']) && !empty($_POST['user_email'])) {
        $user_name = $_POST['user_name'];
        $password = $_POST['user_password'];
        $user_email = $_POST['user_email'];
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        $query = "INSERT INTO users (user_name, user_email, user_password, user_role) VALUES (:unm, :em, :pass, :role)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(
            ':unm' => $user_name,
            ':em' => $user_email,
            ':pass' => $password,
            ':role' => 'subscriber'
        ));
        $_SESSION['success'] = "User succesfully registered";
        header("Location: index.php");

    } else {
        $_SESSION['error'] = "Cannot accept empty fields";
        header("Location: registration.php");
    }
}
?>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="user_name" class="sr-only">username</label>
                            <input type="text" name="user_name" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="user_email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="user_password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
