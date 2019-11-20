<?php 
    include_once "./functions.php";
    
    if (isset($_POST['add_user'])) {
        insert_user();
    }

    if (isset($_POST['cancel'])) {
        header("Location: ./users.php");
    }
?>

<form action ="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_first_name">First Name</label>
        <input type="text" class="form-control" name="user_first_name">
    </div>
    <div class="form-group">
        <label for="user_last_name">Last Name</label>
        <input type="text" class="form-control" name="user_last_name">
    </div>
    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>
    <div class="form-group">
        <label for="user_name">Username</label>
        <input type="text" class="form-control" name="user_name">
    </div>
    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>
    <div class="form-group">
        <label for="user_role">Access</label>
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</opton>
        </select>
    </div>
    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" class="form-control" name="user_image">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="add_user" value="Sign Up">
        <input class="btn btn-primary" type="submit" name="cancel" value="Cancel">
    </div>
</form>