<?php 
    include_once "./functions.php";
    
    if (isset($_POST['edit_user'])) {
        update_user($_GET['u_id']);
    }

    if (isset($_POST['cancel'])) {
        header("Location: ./users.php");
    }

    //grabbing existing post data from db
    if (isset($_GET['u_id'])) {  

        $query = "SELECT * FROM users WHERE user_id = :uid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array(":uid" => $_GET['u_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $user_id = $_GET['u_id'];
        $user_first_name = $row['user_first_name'];
        $user_last_name = $row['user_last_name'];
        $user_email = $row['user_email'];
        $user_name = $row['user_name'];
        $user_password = $row['user_password'];
        $user_role = $row['user_role'];
        $user_image = $row['user_image'];
    } else {
        die("Oops no ID");
    }
  
?>

<form action ="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_first_name">First Name</label>
        <input type="text" class="form-control" name="user_first_name" value="<?php echo $user_first_name; ?>">
    </div>
    <div class="form-group">
        <label for="user_last_name">Last Name</label>
        <input type="text" class="form-control" name="user_last_name" value="<?php echo $user_last_name; ?>">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name" value="<?php echo $user_name; ?>">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input autocomplete="off" type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label></br>
        <img width="100" src="../images/<?php echo $user_image; ?>" alt="user-image">
        <input type="file" class="form-control" name="user_image">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
        <input class="btn btn-primary" type="submit" name="cancel" value="Cancel">
    </div>
</form>