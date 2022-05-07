<?php
ob_start();

session_start();
$pageTitle = 'Items';

if (isset($_SESSION['user'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {
        $statement = $con->prepare("SELECT items.* ,categories.Name AS category_name ,users.Username FROM items
        INNER JOIN categories ON categories.ID = items.Cat_ID
        INNER JOIN users ON users.UserID = items.Member_ID
        ");
        $statement->execute();
        $items = $statement->fetchAll();
        if (!empty($items)) {


?>
            <div class="text-center head_form_edit"> Mange Items</div>
            <div class="container">
                <div class="table-responsive">
                    <table class="text-center table table-dark table-striped ">
                        <thead>
                            <tr>
                                <th scope="col"><i class="fab fa-ideal"></i> </th>
                                <th scope="col"><i class="fas fa-user-circle"></i> Name</th>
                                <th scope="col"><i class="fas fa-file-medical"></i> Description</th>
                                <th scope="col"><i class="fas fa-dollar-sign"></i> Price</th>
                                <th scope="col"><i class="fas fa-calendar-alt"></i> Adding Date</th>
                                <th scope="col"><i class="fas fa-tags"></i> Category</th>
                                <th scope="col"><i class="fas fa-user-circle"></i> Username</th>
                                <th scope="col"><i class="fas fa-tools"></i> Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($items as $item) {
                                echo "<tr>";
                                echo "<td>" . $item['Item_ID'] . "</td>";
                                echo "<td>" . $item['Name'] . "</td>";
                                echo "<td>" . $item['Description'] . "</td>";
                                echo "<td>" . $item['Price'] . "</td>";
                                echo "<td>" . $item['Add_Date'] . "</td>";
                                echo "<td>" . $item['category_name'] . "</td>";
                                echo "<td>" . $item['Username'] . "</td>";
                                echo "<td>
                                    <a href='items.php?do=Edit&itemId=" . $item['Item_ID'] . " 'class='btn btn-success'><i class='fas fa-user-edit'></i> Edit</a>
                                    <a href='items.php?do=Delete&itemId=" . $item['Item_ID'] . "' class='btn btn-danger confirm'><i class='fas fa-trash-alt'></i> Delete</a>";
                                if ($item['Approve'] == 0) {
                                    echo   "<a href='items.php?do=Approve&itemId=" . $item['Item_ID'] . " 'class='btn btn-info btn_activate'><i class='fas fa-check-square'></i> Approve</a>";
                                }
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <a class='text-center btn btn-outline-info' href='items.php?do=Add'><i class='fas fa-calendar-plus'></i> Add Item</a>
            </div>
        <?php
        } else {
            echo "<div class='container'>
            <div class='nice_msg'>
            This Is No Record To Show
            </div>
            <a class='text-center btn btn-outline-info' href='items.php?do=Add'><i class='fas fa-calendar-plus'></i> Add Item</a>
            </div>
            ";
        }
    } elseif ($do == 'Add') {
        ?>
        <div class="container">
            <div class="text-center head_form_edit"> Add New Item</div>
            <form class="form-horizontal col-md-6" method="POST" action="?do=Insert">
                <div class="mb-3">
                    <label for="exampleInputName1" class="form-label">Name</label>
                    <input id="exampleInputName1" type="text" class="form-control col-md-6" name="name" placeholder="Name of the Item" required="required" placeholder="Name of the items" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputDescription1" class="form-label">Description</label>
                    <input id="exampleInputDescription1" type="text" placeholder="Description" name="description" autocomplete="off" required="required" class=" form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder1" class="form-label">Price</label>
                    <input id="exampleInputOrder1" type="text" placeholder="price" name="price" class="form-control" required="required" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder8" class="form-label">Image</label>
                    <input id="exampleInputOrder8" type="text" placeholder="image path" name="img" class="form-control" required="required" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder2" class="form-label">Country</label>
                    <input id="exampleInputOrder2" type="text" placeholder="Country" name="country" class="form-control" required="required" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder3" class="form-label">Status</label>
                    <select id="exampleInputOrder3" name="status" class="form-select form-select-sm" aria-label=".form-select-sm example" required="required">
                        <option value="0">...</option>
                        <option value="1">New</option>
                        <option value="2">Like New</option>
                        <option value="3">Used</option>
                        <option value="4">Old</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder3" class="form-label">Member</label>
                    <select id="exampleInputOrder3" name="member" class="form-select form-select-sm" aria-label=".form-select-sm example" required="required">
                        <option value="0">...</option>
                        <?php
                        $stat = $con->prepare("SELECT * FROM users");
                        $stat->execute();
                        $users = $stat->fetchAll();
                        foreach ($users as $user) {
                            echo "<option value='" . $user['UserID'] . "'>" . $user['Username'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder3" class="form-label">Categories</label>
                    <select id="exampleInputOrder3" name="categories" class="form-select form-select-sm" aria-label=".form-select-sm example" required="required">
                        <option value="0">...</option>
                        <?php
                        $stat2 = $con->prepare("SELECT * FROM categories");
                        $stat2->execute();
                        $cats = $stat2->fetchAll();
                        foreach ($cats as $cat) {
                            echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" name="submit" value="Add Item" class="btn mt-3 mb-3 btn-success">
            </form>
        </div>
        <?php
    } elseif ($do == 'Insert') {
        // insert members page
        echo "<h1 class='text-center head_form_edit'>Insert PAGE </h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Get variables
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $price      = $_POST['price'];
            $img        = $_POST['img'];
            $country    = $_POST['country'];
            $status     = $_POST['status'];
            $member     = $_POST['member'];
            $cat        = $_POST['categories'];

            // Validate the form
            $formErrors = array();

            if (empty($name)) {
                $formErrors[] = "Name Can't be Empty";
            }
            if (empty($desc)) {
                $formErrors[] = "Description Can't be Empty";
            }
            if (empty($price)) {
                $formErrors[] = "Price Can't be Empty";
            }
            if (empty($img)) {
                $formErrors[] = "Image path Can't be Empty";
            }
            if (empty($country)) {
                $formErrors[] = "Country Can't be Empty";
            }
            if ($status == 0) {
                $formErrors[] = "Status Can't be Empty";
            }
            if ($member == 0) {
                $formErrors[] = "Member Can't be Empty";
            }
            if ($cat == 0) {
                $formErrors[] = "Category Can't be Empty";
            }

            foreach ($formErrors as $e) {
                $errorMsg = "<div class='alert alert-danger '>" . $e . "</div>";
                redirectHome($errorMsg, 'back');
            }
            // if there is no errors then update the data form
            if (empty($formErrors)) {
                $statement = $con->prepare('INSERT INTO
            items(Name,Description,Price,Imge,Country_Made,Status,Add_Date,Cat_ID,Member_ID)
            VALUES(:znamne,:zdesc,:zprice,:zimg,:zcountry,:zstat,now(),:zcat,:zmember)');
                $statement->execute(array(
                    'znamne'    => $name,
                    'zdesc'     => $desc,
                    'zprice'    => $price,
                    'zimg'      => $img,
                    'zcountry'  => $country,
                    'zstat'     => $status,
                    'zcat'      => $cat,
                    'zmember'   => $member
                ));
                $errorMsg = "<div class='alert alert-success '>" . $statement->rowCount() . " record Updated" . "</div>";
                redirectHome($errorMsg, 'back');
            }
            // Update the data
        } else {
            $massage = "<div class='alert alert-danger'>You can't Browse this Page Directly</div>";
            redirectHome($massage);
        }
        echo '</div>';
    } elseif ($do == 'Edit') {
        $item_id = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0;
        // check if user exist in database or not

        $statement = $con->prepare("SELECT * FROM items WHERE Item_ID = ? LiMIT 1");
        $statement->execute(array($item_id));
        $items = $statement->fetch();
        $count = $statement->rowCount();
        if ($count > 0) {
        ?>

            <div class="text-center head_form_edit"> Edit item</div>
            <form class="form-horizontal col-md-6" method="POST" action="?do=Update">
                <input type="hidden" name="itemId" value="<?php echo $item_id ?>">
                <div class="mb-3">
                    <label for="exampleInputName1" class="form-label">Name</label>
                    <input id="exampleInputName1" type="text" class="form-control col-md-6" name="name" placeholder="Name of the Item" value="<?php echo $items['Name']; ?>" required="required" placeholder="Name of the items" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputDescription1" class="form-label">Description</label>
                    <input id="exampleInputDescription1" type="text" placeholder="Description" name="description" autocomplete="off" value="<?php echo $items['Description']; ?>" required="required" class=" form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder1" class="form-label">Price</label>
                    <input id="exampleInputOrder1" type="text" placeholder="price" name="price" class="form-control" required="required" value="<?php echo $items['Price']; ?>" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder8" class="form-label">Image</label>
                    <input id="exampleInputOrder8" type="text" placeholder="img" name="img" class="form-control" required="required" value="<?php echo $items['Imge']; ?>" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder2" class="form-label">Country</label>
                    <input id="exampleInputOrder2" type="text" placeholder="Country" name="country" class="form-control" required="required" value="<?php echo $items['Country_Made']; ?>" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder3" class="form-label">Status</label>
                    <select id="exampleInputOrder3" name="status" class="form-select form-select-sm" aria-label=".form-select-sm example" required="required">
                        <option value="1" <?php if ($items['Status'] == 1) {
                                                echo "selected";
                                            } ?>>New</option>
                        <option value="2" <?php if ($items['Status'] == 2) {
                                                echo "selected";
                                            }  ?>>Like New</option>
                        <option value="3" <?php if ($items['Status'] == 3) {
                                                echo "selected";
                                            } ?>>Used</option>
                        <option value="4" <?php if ($items['Status'] == 4) {
                                                echo "selected";
                                            }  ?>>Old</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder3" class="form-label">Member</label>
                    <select id="exampleInputOrder3" name="member" class="form-select form-select-sm" aria-label=".form-select-sm example" required="required">
                        <?php
                        $stat = $con->prepare("SELECT * FROM users");
                        $stat->execute();
                        $users = $stat->fetchAll();
                        foreach ($users as $user) {
                            echo "<option value='" . $user['UserID'] . "'";
                            if ($items['Member_ID'] == $user['UserID']) {
                                echo "selected";
                            }
                            echo ">" . $user['Username'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder3" class="form-label">Categories</label>
                    <select id="exampleInputOrder3" name="categories" class="form-select form-select-sm" aria-label=".form-select-sm example" required="required">
                        <?php
                        $stat2 = $con->prepare("SELECT * FROM categories");
                        $stat2->execute();
                        $cats = $stat2->fetchAll();
                        foreach ($cats as $cat) {
                            echo "<option value='" . $cat['ID'] . "'";
                            if ($items['Cat_ID'] == $cat['ID']) {
                                echo " selected";
                            }
                            echo ">" . $cat['Name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" name="submit" value="Save Item" class="btn mt-3 mb-3 btn-success">
            </form>
            <?php
            $statement = $con->prepare("SELECT
                comments.*,Users.Username
                FROM
                comments
                INNER JOIN
                users
                ON
                users.UserID = comments.user_id
                WHERE
                item_id = ?
                ");
            $statement->execute(array($item_id));
            $comments = $statement->fetchAll();
            if (!empty($comments)) {
            ?>
                <div class="text-center head_form_edit">[ <?php echo $items['Name']; ?> ] Comments</div>
                <div class="container">
                    <div class="table-responsive">
                        <table class="text-center table table-dark table-striped ">
                            <thead>
                                <tr>
                                    <th scope="col"><i class="fas fa-user-circle"></i> comment</th>
                                    <th scope="col"><i class="fas fa-id-card-alt"></i> Comment Date</th>
                                    <th scope="col"><i class="fas fa-id-card-alt"></i> User Name</th>
                                    <th scope=" col"><i class="fas fa-tools"></i> Control Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($comments as $comment) {
                                    echo "<tr>";
                                    echo "<td>" . $comment['comment'] . "</td>";
                                    echo "<td>" . $comment['comment_date'] . "</td>";
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
            <?php } ?>
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
            $item_id    = $_POST['itemId'];
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $price      = $_POST['price'];
            $img        = $_POST['img'];
            $country    = $_POST['country'];
            $status     = $_POST['status'];
            $member     = $_POST['member'];
            $cat        = $_POST['categories'];

            // Validate the form 
            $formErrors = array();

            if (empty($name)) {
                $formErrors[] = "Name Can't be Empty";
            }
            if (empty($desc)) {
                $formErrors[] = "Description Can't be Empty";
            }
            if (empty($price)) {
                $formErrors[] = "Price Can't be Empty";
            }
            if (empty($img)) {
                $formErrors[] = "Image Can't be Empty";
            }
            if (empty($country)) {
                $formErrors[] = "Country Can't be Empty";
            }
            if ($status == 0) {
                $formErrors[] = "Status Can't be Empty";
            }
            if ($member == 0) {
                $formErrors[] = "Member Can't be Empty";
            }
            if ($cat == 0) {
                $formErrors[] = "Category Can't be Empty";
            }

            foreach ($formErrors as $e) {
                $errorMsg = "<div class='alert alert-danger '>" . $e . "</div>";
                redirectHome($errorMsg, 'back');
            }
            // if there is no errors then update the data form
            if (empty($formErrors)) {
                $statement = $con->prepare("UPDATE 
                                                items 
                                            SET
                                                Name = ?,
                                                Description = ?,
                                                Price= ? ,
                                                Imge= ? ,
                                                Country_Made = ?,
                                                Status = ?,
                                                Member_ID =? ,
                                                Cat_ID=?
                                            WHERE
                                                Item_ID  = ?");
                $statement->execute(array($name, $desc, $price, $img, $country, $status, $member, $cat, $item_id));
                $massage = "<div class='alert alert-success '>" . $statement->rowCount() . " record Updated" . "</div>";
                redirectHome($massage, 'back', 3);
            }
            // Update the data 
        } else {
            $errorMsg = " <div class='alert alert-danger'>You can't Browse this Page Directly</div>";
            redirectHome($errorMsg, 5);
        }
        echo '</div>';
    } elseif ($do == 'Delete') {
        echo "<h1 class='text-center head_form_edit'>Delete PAGE </h1>";
        echo "<div class='container'>";
        $item_id = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0;
        // check if user exist in database or not
        $check_item = isItemExists('Item_ID', 'items', $item_id);


        if ($check_item > 0) {
            $statement =  $con->prepare("DELETE FROM items WHERE Item_ID =:zid");
            $statement->bindParam(":zid", $item_id);
            $statement->execute();
            $errorMsg = "<div class='alert alert-success '>" . $statement->rowCount() . " record Delete" . "</div>";
            redirectHome($errorMsg);
        } else {
            $errorMsg =  " <div class='alert alert-danger'>Error No Such Id </div>";
            redirectHome($errorMsg, 5);
        }
        echo "</div>";
    } elseif ($do == 'Approve') {
        echo "<h1 class='text-center head_form_edit'>Approve Member PAGE </h1>";
        echo "<div class='container'>";
        $item_id = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0;
        // check if user exist in database or not
        $check_item = isItemExists('Item_ID', 'items', $item_id);


        if ($check_item > 0) {
            $statement =  $con->prepare("UPDATE items SET Approve = 1 WHERE Item_ID = ? ");
            $statement->execute(array($item_id));
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
ob_end_flush();
