<?php
/*
----------------------------------------------------------------
***** Manage Comments page
***** You can Add | Edit | Delete | Update Members From this page
----------------------------------------------------------------
*/
session_start();

$pageTitle = 'Comments';

if (isset($_SESSION['user'])) {
    include 'init.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {


        $statement = $con->prepare("SELECT
                                            comments.*,items.Name,Users.Username
                                    FROM 
                                            comments
                                    INNER JOIN
                                            items        
                                    ON
                                            items.Item_ID = comments.item_id
                                    INNER JOIN
                                            users
                                    ON
                                            users.UserID = comments.user_id    
         ");
        $statement->execute();
        $comments = $statement->fetchAll();
        if (!empty($comments)) {

?>
            <div class="text-center head_form_edit"> Mange Comments</div>
            <div class="container">
                <div class="table-responsive">
                    <table class="text-center table table-dark table-striped ">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fab fa-ideal"></i> </th>
                                <th scope="col"><i class="fas fa-user-circle"></i> comment</th>
                                <th scope="col"><i class="fas fa-id-card-alt"></i> Comment Date</th>
                                <th scope="col"><i class="fas fa-calendar-alt"></i> Item Name</th>
                                <th scope="col"><i class="fas fa-id-card-alt"></i> User Name</th>
                                <th scope=" col"><i class="fas fa-tools"></i> Control Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($comments as $comment) {
                                echo "<tr>";
                                echo "<td>" . $comment['c_id'] . "</td>";
                                echo "<td>" . $comment['comment'] . "</td>";
                                echo "<td>" . $comment['comment_date'] . "</td>";
                                echo "<td>" . $comment['Name'] . "</td>";
                                echo "<td>" . $comment['Username'] . "</td>";
                                echo "<td>
                                    <a href='comments.php?do=Edit&comId=" . $comment['c_id'] . " 'class='btn btn-success'><i class='fas fa-user-edit'></i> Edit</a>
                                    <a href='comments.php?do=Delete&comId=" . $comment['c_id'] . "' class='btn btn-danger confirm'><i class='fas fa-trash-alt'></i> Delete</a>";
                                if ($comment['status'] == 0) {
                                    echo   "<a href='comments.php?do=Approve&comId=" . $comment['c_id'] . " 'class='btn btn-info btn_activate'><i class='fas fa-check-square'></i> Approve</a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } else {
            echo "<div class='container'>
            <div class='nice_msg'>
            This Is No Record To Show
            </div>
            </div>
            ";
        }
    } elseif ($do == 'Edit') {

        $comment_id = isset($_GET['comId']) && is_numeric($_GET['comId']) ? intval($_GET['comId']) : 0;
        // check if user exist in database or not

        $statement = $con->prepare("SELECT * FROM comments WHERE c_id = ? LiMIT 1");
        $statement->execute(array($comment_id));
        $row = $statement->fetch();
        $count = $statement->rowCount();
        if ($count > 0) { ?>

            <div class="text-center head_form_edit"> Edit Comment</div>
            <form class="form-horizontal col-md-6" method="POST" action="?do=Update">
                <input type="hidden" name="comId" value="<?php echo $comment_id ?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Comment</label>
                    <textarea class="form-control" name="comment" required="required" placeholder="Comment" autocomplete="off"><?php echo $row['comment']; ?></textarea>
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
            $comment_id    = $_POST['comId'];
            $comment  = $_POST['comment'];

            $statement = $con->prepare('UPDATE comments SET comment = ? WHERE c_id = ?');
            $statement->execute(array($comment, $comment_id));
            $massage = "<div class='alert alert-success '>" . $statement->rowCount() . " record Updated" . "</div>";
            redirectHome($massage, 'back', 3);

            // Update the data 
        } else {
            $errorMsg = " <div class='alert alert-danger'>You can't Browse this Page Directly</div>";
            redirectHome($errorMsg, 5);
        }
        echo '</div>';
    } elseif ($do == 'Delete') {
        // Delete the comment
        echo "<h1 class='text-center head_form_edit'>Delete PAGE </h1>";
        echo "<div class='container'>";
        $comment_id = isset($_GET['comId']) && is_numeric($_GET['comId']) ? intval($_GET['comId']) : 0;
        // check if comment exist in database or not
        $check_comment = isItemExists('c_id', 'comments', $comment_id);


        if ($check_comment > 0) {
            $statement =  $con->prepare("DELETE FROM comments WHERE c_id =:zcid ");
            $statement->bindParam(":zcid", $comment_id);
            $statement->execute();
            $errorMsg = "<div class='alert alert-success '>" . $statement->rowCount() . " record Delete" . "</div>";
            redirectHome($errorMsg);
        } else {
            $errorMsg =  " <div class='alert alert-danger'>Error No Such Id </div>";
            redirectHome($errorMsg, 5);
        }
        echo "</div>";
    } elseif ($do == 'Approve') {
        // Approve  comment
        echo "<h1 class='text-center head_form_edit'>Approve Comment </h1>";
        echo "<div class='container'>";
        $comment_id = isset($_GET['comId']) && is_numeric($_GET['comId']) ? intval($_GET['comId']) : 0;
        // check if user exist in database or not
        $check_comment = isItemExists('c_id', 'comments', $comment_id);


        if ($check_comment > 0) {
            $statement =  $con->prepare("UPDATE comments SET status = 1 WHERE c_id = ? ");
            $statement->execute(array($comment_id));
            $errorMsg = "<div class='alert alert-success '>" . $statement->rowCount() . " record Approved" . "</div>";
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
