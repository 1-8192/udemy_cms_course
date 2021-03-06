<!DOCTYPE html>
<html lang="en">

<?php 
    include_once "includes/admin_header.php";
    include_once "includes/user_functions.php";

    if (!is_admin($_SESSION['user_name'])) {
        header("Location: ../index.php");
    }
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
                            Welcome, Admin
                            <small>Users</small>
                        </h1>
                        
                        <?php 
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = "";
                            }

                            switch($source) {
                                case 'add_user';
                                    include "includes/add_user.php";
                                break;
                                case 'edit_user';
                                    include "includes/edit_user.php";
                                break;
                                default:
                                    include "includes/view_all_users.php";
                                break;  
                            }
                        
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include_once "includes/admin_footer.php" ?>

</body>

</html>