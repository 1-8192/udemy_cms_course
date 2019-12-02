<?php  
    include "includes/db.php"; 
    include_once "includes/util_user_functions.php";
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

 if (isset($_SESSION['success'])) {
    $message = $_SESSION['success'];
    echo '<p class="text-center" style="color:green">'."$message".'</p>';
    unset($_SESSION['success']);
 }

 if (isset($_POST['submit'])) {
     if (!empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['body'])) {
        $header = "From:".$_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        $msg = wordwrap($subject, 70, "\r\n");
        mail("myemail@email.com", $subject, $msg, $header);

        $_SESSION['success'] = "Email sent";
        header("Location: contact.php");

    } else {
        $_SESSION['error'] = "Cannot accept empty fields";
        header("Location: contact.php");
    }
}
?>
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact Us</h1>
                    <form role="form" action="contact.php" method="post" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Topic">
                        </div>
                         <div class="form-group">
                            <label for="body" class="sr-only">Message</label>
                            <textarea name="body" class="form-control" placeholder="I need help..." cols="50" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-contact" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>