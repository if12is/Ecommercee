<?php
/*
----------------------------------------------------------------
***** Manage Members page
***** You can Add | Edit | Delete | Update Members From this page
----------------------------------------------------------------
*/
session_start();

$pageTitle = 'Manage Members';

if (isset($_SESSION['user'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {

        $query = '';
        if (isset($_GET['page']) && $_GET['page'] == 'pending') {
            $query = 'AND RegStatus = 0';
        }

        $statement = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");
        $statement->execute();
        $rows = $statement->fetchAll();
        if (!empty($rows)) {

?>
            <div class="text-center head_form_edit"> Mange Members</div>
            <div class="container">
                <div class="table-responsive">
                    <table class="text-center table table-dark table-striped ">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fab fa-ideal"></i> </th>
                                <th scope="col"><i class="fas fa-user-circle"></i> User Name</th>
                                <th scope="col"><i class="fas fa-envelope"></i> Email</th>
                                <th scope="col"><i class="fas fa-id-card-alt"></i> Full Name</th>
                                <th scope="col"><i class="fas fa-calendar-alt"></i> Registered Date</th>
                                <th scope="col"><i class="fas fa-tools"></i> Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['UserID'] . "</td>";
                                echo "<td>" . $row['Username'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td>" . $row['FullName'] . "</td>";
                                echo "<td>" . $row['Date'] . "</td>";
                                echo "<td>
                                    <a href='members.php?do=Edit&userId=" . $row['UserID'] . " 'class='btn btn-success'><i class='fas fa-user-edit'></i> Edit</a>
                                    <a href='members.php?do=Delete&userId=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fas fa-trash-alt'></i> Delete</a>";
                                if ($row['RegStatus'] == 0) {
                                    echo   "<a href='members.php?do=Activate&userId=" . $row['UserID'] . " 'class='btn btn-info btn_activate'><i class='fas fa-check-square'></i> Activate</a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <a class="text-center btn btn-outline-info" href="members.php?do=Add"><i class="fas fa-calendar-plus"></i> Add Members</a>
            </div>
        <?php
        } else {
            echo "<div class='container'>
            <div class='nice_msg'>
            This Is No Record To Show
            </div>
            <a class='text-center btn btn-outline-info' href='members.php?do=Add'><i class='fas fa-calendar-plus'></i> Add Members</a>
            </div>
            ";
        }
    } elseif ($do == 'Add') {
        // Add Manage Members page
        ?>
        <div class="container">
            <div class="text-center head_form_edit"> Add New Members</div>
            <form class="form-horizontal col-md-6" method="POST" action="?do=Insert">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">UserName</label>
                    <input type="text" class="form-control col-md-6" name="UserName" placeholder="UserName" required="required" placeholder="User Name" autocomplete="off">
                </div>
                <div class="mb-3 pass_con">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" placeholder="password" name="password" autocomplete="new-password" required="required" class="password form-control">
                    <i class="far fa-eye show-pass"></i>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" placeholder="Email" name="Email" class="form-control" required="required" autocomplete="off" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Full Name</label>
                    <input type="text" placeholder="Full Name" name="full" class="form-control" required="required" autocomplete="off">
                </div>
                <input type="submit" name="submit" value="Add Member" class="btn btn-success">
            </form>
        </div>

        <?php

    } elseif ($do == 'Insert') {
        // insert members page
        echo "<h1 class='text-center head_form_edit'>Insert PAGE </h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Get variables
            $user_name  = $_POST['UserName'];
            $full       = $_POST['full'];
            $email      = $_POST['Email'];
            $pass       = $_POST['password'];
            $hash_pass  = sha1($pass);

            // Validate the form 
            $formErrors = array();

            if (strlen($user_name) < 4) {
                $formErrors[] = "User Name Can't be Less Than 4 characters";
            }
            if (strlen($user_name) > 20) {
                $formErrors[] = "User Name Can't be More Than 20 Character";
            }
            if (empty($user_name)) {
                $formErrors[] = "User Name Can't be Empty";
            }
            if (empty($full)) {
                $formErrors[] = "Full Name Can't be Empty";
            }
            if (empty($pass)) {
                $formErrors[] = "Password Can't be Empty";
            }
            if (empty($email)) {
                $formErrors[] = "Email Can't be Empty";
            }
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $formErrors[] = "Inter Veiled Email";
            }

            foreach ($formErrors as $e) {
                $errorMsg = "<div class='alert alert-danger '>" . $e . "</div>";
                redirectHome($errorMsg, 'back');
            }
            // if there is no errors then update the data form
            if (empty($formErrors)) {
                $check = isItemExists("UserName", "users", $user_name);
                if ($check == 1) {
                    $errorMsg = "<div class='alert alert-danger'>Sorry the username you are insert it is valid already</div>";
                    redirectHome($errorMsg, 'back');
                } else {
                    $statement = $con->prepare('INSERT INTO
                                            users(Username,Password,Email,FullName,RegStatus,Date)
                                            VALUES(:zuser,:zpass,:zmail,:zname,1,now())   ');
                    $statement->execute(array(
                        'zuser'  => $user_name,
                        'zpass'  => $hash_pass,
                        'zmail'  => $email,
                        'zname'  => $full
                    ));
                    $errorMsg = "<div class='alert alert-success '>" . $statement->rowCount() . " record Updated" . "</div>";
                    redirectHome($errorMsg, 'back');
                }
            }
            // Update the data 
        } else {
            $massage = "<div class='alert alert-danger'>You can't Browse this Page Directly</div>";
            redirectHome($massage);
        }
        echo '</div>';
    } elseif ($do == 'Edit') {

        $user_id = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;
        // check if user exist in database or not

        $statement = $con->prepare("SELECT * FROM users WHERE UserID = ? LiMIT 1");
        $statement->execute(array($user_id));
        $row = $statement->fetch();
        $count = $statement->rowCount();
        if ($count > 0) { ?>

            <div class="text-center head_form_edit"> Edit Members</div>
            <form class="form-horizontal col-md-6" method="POST" action="?do=Update">
                <input type="hidden" name="userId" value="<?php echo $user_id ?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">UserName</label>
                    <input type="text" class="form-control" name="UserName" value="<?php echo $row['Username']; ?>" placeholder="UserName" required="required" id="exampleInputEmail1" placeholder="User Name" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="hidden" placeholder="old_password" name="old_Password" value="<?php echo $row['Password']; ?>">
                    <input type="password" placeholder="password" name="new_Password" autocomplete="new-password" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" placeholder="Email" name="Email" class="form-control" value="<?php echo $row['Email']; ?>" required="required" autocomplete="off" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Full Name</label>
                    <input type="text" placeholder="Full Name" name="full" class="form-control" value="<?php echo $row['FullName']; ?>" autocomplete="off" required="required">
                </div>
                <input type="submit" name="submit" value="submit" class="btn btn-success">
            </form>

<?php
        } else {
            $errorMsg = "<div class='alert alert-danger'>No Such Id</div>";
            redirectHome($errorMsg, 5);
        }
    } elseif ($do == 'Update') {
        echo "<h1 class='text-center head_form_edit'>UPDATE PAGE </h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Get variables
            $user_id    = $_POST['userId'];
            $user_name  = $_POST['UserName'];
            $full       = $_POST['full'];
            $email      = $_POST['Email'];

            // Password trick 
            $pass   = empty($_POST['new_Password']) ? $_POST['old_Password'] : sha1($_POST['new_Password']);
            // Validate the form 
            $formErrors = array();

            if (strlen($user_name) < 4) {
                $formErrors[] = "<div class='alert alert-danger '>User Name Can't be Less Than 4 characters</div>";
            }
            if (strlen($user_name) > 20) {
                $formErrors[] = "<div class='alert alert-danger '>User Name Can't be More Than 20 Character</div>";
            }
            if (empty($user_name)) {
                $formErrors[] = "<div class='alert alert-danger '>User Name Can't be Empty</div>";
            }
            if (empty($full)) {
                $formErrors[] = "<div class='alert alert-danger '>Full Name Can't be Empty</div>";
            }
            if (empty($email)) {
                $formErrors[] = "<div class='alert alert-danger '>Email Can't be Empty</div>";
            }
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $formErrors[] = "<div class='alert alert-danger '>Inter Veiled Email</div>";
            }

            foreach ($formErrors as $e) {
                echo $e;
            }
            // if there is no errors then update the data form
            if (empty($formErrors)) {
                $stmt = $con->prepare("SELECT * FROM users WHERE Username = ? AND UserID != ?");
                $stmt->execute(array($user_name, $user_id));
                $count = $stmt->rowCount();
                if ($count == 1) {
                    $massage = "<div class='nice_msg my-3'>Sorry this Name is already exist</div>";
                    redirectHome($massage, 'back', 3);
                } else {
                    $statement = $con->prepare('UPDATE users SET Username = ?, Email = ?, Password= ? ,FullName = ? WHERE UserID = ?');
                    $statement->execute(array($user_name, $email, $pass, $full, $user_id));
                    $massage = "<div class='alert alert-success '>" . $statement->rowCount() . " record Updated" . "</div>";
                    redirectHome($massage, 'back', 3);
                }
            }
            // Update the data 
        } else {
            $errorMsg = " <div class='alert alert-danger'>You can't Browse this Page Directly</div>";
            redirectHome($errorMsg, 5);
        }
        echo '</div>';
    } elseif ($do == 'Delete') {
        // Delete the user
        echo "<h1 class='text-center head_form_edit'>Delete PAGE </h1>";
        echo "<div class='container'>";
        $user_id = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;
        // check if user exist in database or not
        $check_user = isItemExists('userId', 'users', $user_id);


        if ($check_user > 0) {
            $statement =  $con->prepare("DELETE FROM users WHERE UserID =:zuser ");
            $statement->bindParam(":zuser", $user_id);
            $statement->execute();
            $errorMsg = "<div class='alert alert-success '>" . $statement->rowCount() . " record Delete" . "</div>";
            redirectHome($errorMsg);
        } else {
            $errorMsg =  " <div class='alert alert-danger'>Error No Such Id </div>";
            redirectHome($errorMsg, 5);
        }
        echo "</div>";
    } elseif ($do == 'Activate') {
        // Activate  user
        echo "<h1 class='text-center head_form_edit'>Activate Member PAGE </h1>";
        echo "<div class='container'>";
        $user_id = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0;
        // check if user exist in database or not
        $check_user = isItemExists('userId', 'users', $user_id);


        if ($check_user > 0) {
            $statement =  $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ? ");
            $statement->execute(array($user_id));
            $errorMsg = "<div class='alert alert-success '>" . $statement->rowCount() . " record Activated" . "</div>";
            redirectHome($errorMsg);
        } else {
            $errorMsg =  " <div class='alert alert-danger'>Error No Such Id </div>";
            redirectHome($errorMsg, 5);
        }
        echo "</div>";
    }
    include $tmpl . 'footer.php';
} else {

    header('Location: index.php'); // redirect to dashboard

    exit();
}
