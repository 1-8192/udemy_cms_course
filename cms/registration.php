<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
<?php 
 if (isset($_POST['submit'])) {
     if (!empty($_POST['user_name']) && !empty($_POST['password']) && !empty($_POST['user_email'])) {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $user_email = $_POST['user_email'];

        $query = "SELECT rand_salt FROM users";
        $stmt = $pdo->query($query);

        if (!$stmt) {
            die("Query failed" . PDOException($exception));
        }

        $rand_salt = $stmt->fetch(PDO::FETCH_ASSOC);
        
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
