<?php 
                                    //update logic
                                    if (isset($_GET['edit'])) {
                                        $cat_id = $_GET['edit'];

                                        $query = 'SELECT * FROM categories WHERE cat_id = :cid';
                                        $stmt = $pdo->prepare($query);
                                        $stmt->execute(array(':cid' => $cat_id));
                                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $cat_title = $row['cat_title'];
                                        $cat_id = $row['cat_id'];
                                    }

                                    if (isset($_POST['update'])) {
                                        try {
                                            $cat_title = $_POST['cat_title'];
                                        $query = "UPDATE categories SET cat_title = :ctitle WHERE cat_id = :cid";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->execute(array(
                                            ':cid' => $cat_id,
                                            ':ctitle' => $cat_title));
                                        header("location: categories.php");
                                        }
                                        catch(PDOException $exception) {
                                            return $exception;
                                        }
                                    }

                                    //conditional HTML display for update form
                                    if (isset($row)) {
                                        echo('</form>
                                        <form action="" method="POST">
                                            <div class="form-group">
                                                <label for="cat_title">Update Category</label>
                                                <input class="form-control" type="text" name="cat_title" value='."$cat_title".'>
                                            </div>
                                            <div class="form-group">
                                                <input class="btn btn-primary" type="submit" name="update" value="Update">
                                            </div>');
                                    }    
                                ?>