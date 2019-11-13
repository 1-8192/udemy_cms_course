<!DOCTYPE html>
<html lang="en">

<?php 
    include_once "includes/admin_header.php";
    include_once "./functions.php";

    if (isset($_POST['edit_user'])) {
        update_user($_SESSION['user_id']);
    }

    if (isset($_POST['cancel'])) {
        header("Location: ./index.php");
    }

    if (isset($_SESSION['user_name'])) {
?>

<body>

    <div id="wrapper">
        <?php include_once "includes/admin_navigation.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome, <?php echo $_SESSION['user_first_name']; ?>
                        </h1>
                        <form action ="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="user_first_name">First Name</label>
                                <input type="text" class="form-control" name="user_first_name" value="<?php echo $_SESSION['user_first_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_last_name">Last Name</label>
                                <input type="text" class="form-control" name="user_last_name" value="<?php echo $_SESSION['user_last_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" class="form-control" name="user_email" value="<?php echo $_SESSION['user_email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_name">Username</label>
                                <input type="text" class="form-control" name="user_name" value="<?php echo $_SESSION['user_name'];; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_password">Password</label>
                                <input type="password" class="form-control" name="user_password" value="<?php echo $_SESSION['user_password'];; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_role">Access</label>
                                <select name="user_role" id="">
                                    <option value="<?php echo $_SESSION['user_role'];; ?>"><?php echo $_SESSION['user_role']; ?></option>
                                    <option value="admin">Admin</option>
                                    <option value="subscriber">Subscriber</opton>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="user_image">User Image</label></br>
                                <img width="100" src="../images/<?php echo $_SESSION['user_image'];; ?>" alt="user-image">
                                <input type="file" class="form-control" name="user_image">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
                                <input class="btn btn-primary" type="submit" name="cancel" value="Cancel">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php
    }
    
    
?>