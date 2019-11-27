<!DOCTYPE html>
<html lang="en">

<?php 
    include_once "includes/admin_header.php";
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
                            <small>Posts</small>
                        </h1>
                        <?php 
                            include_once "includes/delete_modal.php";
                            
                            if (isset($_GET['source'])) {
                                $source = $_GET['source'];
                            } else {
                                $source = "";
                            }

                            switch($source) {
                                case 'add_post';
                                    include "includes/add_post.php";
                                break;
                                case 'edit_post';
                                    include "includes/edit_post.php";
                                break;
                                default:
                                    include "includes/view_all_posts.php";
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

    <?php include_once "includes/admin_footer.php"; ?>

</body>

</html>