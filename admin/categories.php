<?php
ob_start();

session_start();
$pageTitle = 'Categories';

if (isset($_SESSION['user'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {
        // sorted page by default  is ASC   
        $sort = 'ASC';
        // sorted the page 
        $sort_array = array('ASC', 'DESC');
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)) {
            $sort = $_GET['sort'];
        }
        $stat = $con->prepare("SELECT * FROM categories ORDER BY ordering $sort");
        $stat->execute();
        $categories = $stat->fetchAll();
?>
        <div class="container">
            <div class="text-center head_form_edit">Manage Categories</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow bg-body rounded ">
                        <div class="card-header text-secondary bg-warning  fw-bold">
                            <i class="fa fa-tag"></i> Manage Categories
                            <div class="ordering float-end">
                                <span class="text-decoration-none text-dark"><i class="fas fa-sort"></i> Ordering</span>
                                <a href="?sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                echo 'active';
                                                            } ?>"><span class="asc">Asc</span></a> |
                                <a href="?sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                echo 'active';
                                                            } ?>"><span class="desc">Desc</span></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush ">
                                <?php
                                foreach ($categories as $cat) {
                                    echo "<div class='cat'>";
                                    echo "<li class='list-group-item fw-bold'>";
                                    echo "<div class='hidden_btn'>";
                                    echo "
                                    <a href='categories.php?do=Edit&catId=" . $cat['ID'] . "'  class='btn btn-sm btn-success'><i class='fa fa-edit'></i> Edit</a>
                                    <a href='categories.php?do=Delete&catId=" . $cat['ID'] . "' class='btn btn-sm btn-danger confirm'><i class='far fa-window-close'></i> Delete</a>
                                    ";
                                    echo "</div>";
                                    echo '<h3>' . $cat['Name'] . '</h3> ';
                                    echo "<div class='full_view'>";
                                    echo '<p>';
                                    if ($cat['Description'] == '') {
                                        echo '<strong>This Description is Empty</strong>';
                                    } else {
                                        echo '<strong>' . $cat['Description'] . '</strong>';
                                    }
                                    echo '</p>';
                                    if ($cat['Visibility'] == 1) {
                                        echo "<span class='visibility badge bg-danger me-2'><i class='fas fa-eye-slash'></i> Hidden</span>";
                                    }
                                    if ($cat['Allow_Comment']  == 1) {
                                        echo "<span class='comment badge bg-info me-2'><i class='fas fa-comment-slash'></i> Comment Disable</span>";
                                    }
                                    if ($cat['Allow_Ads'] == 1) {
                                        echo "<span class='advertises badge bg-warning me-2'><i class='fab fa-buysellads'></i> Ads Disable</span>";
                                    }
                                    echo '</div>';
                                    echo "</li>";
                                    echo "</div>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <a href="categories.php?do=Add" class="btn mt-3 mb-3 btn-success"><i class="fab fa-shopify"> </i> Add Categories</a>
        </div>
    <?php
    } elseif ($do == 'Add') {
    ?>
        <div class="container">
            <div class="text-center head_form_edit"> Add New Categories</div>
            <form class="form-horizontal col-md-6" method="POST" action="?do=Insert">
                <div class="mb-3">
                    <label for="exampleInputName1" class="form-label">Name</label>
                    <input id="exampleInputName1" type="text" class="form-control col-md-6" name="name" placeholder="Name of the Category" required="required" placeholder="User Name" autocomplete="off">
                </div>
                <div class="mb-3 pass_con">
                    <label for="exampleInputDescription1" class="form-label">Description</label>
                    <input id="exampleInputDescription1" type="text" placeholder="Description" name="description" autocomplete="off" class=" form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleInputOrder1" class="form-label">Ordering</label>
                    <input id="exampleInputOrder1" type="text" placeholder="Ordering" name="ordering" class="form-control" autocomplete="off" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInput1" class="form-label">Visibility</label>
                    <div>
                        <input id="visible-yes" type="radio" name="visibility" value="0" checked />
                        <label for="visible-yes" class="form-label">Yes</label>
                    </div>
                    <div>
                        <input id="visible-no" type="radio" name="visibility" value="1" />
                        <label for="visible-no" class="form-label">No</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInput1" class="form-label">Allow Comments</label>
                    <div>
                        <input id="comm-yes" type="radio" name="comments" value="0" checked />
                        <label for="comm-yes" class="form-label">Yes</label>
                    </div>
                    <div>
                        <input id="comm-no" type="radio" name="comments" value="1" />
                        <label for="comm-no" class="form-label">No</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInput1" class="form-label">Allow Ads</label>
                    <div>
                        <input id="ads-yes" type="radio" name="ads" value="0" checked />
                        <label for="ads-yes" class="form-label">Yes</label>
                    </div>
                    <div>
                        <input id="ads-no" type="radio" name="ads" value="1" />
                        <label for="ads-no" class="form-label">No</label>
                    </div>
                </div>
                <input type="submit" name="submit" value="Add Categories" class="btn mt-3 mb-3 btn-success">
            </form>
        </div>

        <?php
    } elseif ($do == 'Insert') {
        // insert Categories page
        echo "<h1 class='text-center head_form_edit'>Insert PAGE </h1>";
        echo "<div class='container'>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Get variables
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $order      = $_POST['ordering'];
            $visible    = $_POST['visibility'];
            $comments   = $_POST['comments'];
            $ads        = $_POST['ads'];


            // if there is no errors then update the data form
            $check = isItemExists("Name", "categories", $name);
            if ($check == 1) {
                $errorMsg = "<div class='alert alert-danger'>Sorry category that you are insert it is valid already</div>";
                redirectHome($errorMsg, 'back');
            } else {
                $statement = $con->prepare("INSERT INTO
                                            categories(Name, Description, Ordering, Visibility, Allow_Comment, Allow_Ads)
                                            VALUES(:zname ,:zdesc ,:zorder ,:zvisible ,:zcomment ,:zads)");
                $statement->execute(array(
                    'zname'     => $name,
                    'zdesc'     => $desc,
                    'zorder'    => $order,
                    'zvisible'  => $visible,
                    'zcomment'  => $comments,
                    'zads'      => $ads
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
        $cat_id = isset($_GET['catId']) && is_numeric($_GET['catId']) ? intval($_GET['catId']) : 0;
        // check if user exist in database or not

        $statement = $con->prepare("SELECT * FROM categories WHERE ID = ?");
        $statement->execute(array($cat_id));
        $cat = $statement->fetch();
        $count = $statement->rowCount();
        if ($count > 0) { ?>

            <div class="container">
                <div class="text-center head_form_edit"> Edit Categories</div>
                <form class="form-horizontal col-md-6" method="POST" action="?do=Update">
                    <input type="hidden" name="catId" value="<?php echo $cat_id; ?>">
                    <div class="mb-3">
                        <label for="exampleInputName1" class="form-label">Name</label>
                        <input id="exampleInputName1" type="text" class="form-control col-md-6" name="name" placeholder="Name of the Category" required="required" placeholder="User Name" autocomplete="off" value="<?php echo $cat['Name'] ?>">
                    </div>
                    <div class="mb-3 pass_con">
                        <label for="exampleInputDescription1" class="form-label">Description</label>
                        <input id="exampleInputDescription1" type="text" placeholder="Description" name="description" class=" form-control" value="<?php echo $cat['Description'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputOrder1" class="form-label">Ordering</label>
                        <input id="exampleInputOrder1" type="text" placeholder="Ordering" name="ordering" class="form-control" value="<?php echo $cat['Ordering'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput1" class="form-label">Visibility</label>
                        <div>
                            <input id="visible-yes" type="radio" name="visibility" value="0" <?php if ($cat['Visibility'] == 0) {
                                                                                                    echo 'checked';
                                                                                                } ?> />
                            <label for="visible-yes" class="form-label">Yes</label>
                        </div>
                        <div>
                            <input id="visible-no" type="radio" name="visibility" value="1" <?php if ($cat['Visibility'] == 1) {
                                                                                                echo 'checked';
                                                                                            } ?> />
                            <label for="visible-no" class="form-label">No</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput1" class="form-label">Allow Comments</label>
                        <div>
                            <input id="comm-yes" type="radio" name="comments" value="0" <?php if ($cat['Allow_Comment'] == 0) {
                                                                                            echo 'checked';
                                                                                        } ?> />
                            <label for="comm-yes" class="form-label">Yes</label>
                        </div>
                        <div>
                            <input id="comm-no" type="radio" name="comments" value="1" <?php if ($cat['Allow_Comment'] == 1) {
                                                                                            echo 'checked';
                                                                                        } ?> />
                            <label for="comm-no" class="form-label">No</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput1" class="form-label">Allow Ads</label>
                        <div>
                            <input id="ads-yes" type="radio" name="ads" value="0" <?php if ($cat['Allow_Ads'] == 0) {
                                                                                        echo 'checked';
                                                                                    } ?> />
                            <label for="ads-yes" class="form-label">Yes</label>
                        </div>
                        <div>
                            <input id="ads-no" type="radio" name="ads" value="1" <?php if ($cat['Allow_Ads'] == 1) {
                                                                                        echo 'checked';
                                                                                    } ?> />
                            <label for="ads-no" class="form-label">No</label>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Save Category" class="btn mr-3 btn-success">
                </form>
            </div>

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
            // Get variables
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $order      = $_POST['ordering'];
            $visible    = $_POST['visibility'];
            $comments   = $_POST['comments'];
            $ads        = $_POST['ads'];
            $cat_id     = $_POST['catId'];

            // if there is no errors then update the data form
            if (empty($formErrors)) {
                $statement = $con->prepare("UPDATE categories SET Name = ?, Description = ?, Ordering= ? , Visibility = ?,Allow_comment = ? , Allow_Ads = ? WHERE ID = ?");
                $statement->execute(array($name, $desc, $order, $visible, $comments, $ads, $cat_id));
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
        // Delete the user
        echo "<h1 class='text-center head_form_edit'>Delete PAGE </h1>";
        echo "<div class='container'>";
        $cat_id = isset($_GET['catId']) && is_numeric($_GET['catId']) ? intval($_GET['catId']) : 0;
        // check if user exist in database or not
        $check_user = isItemExists('ID', 'categories', $cat_id);


        if ($check_user > 0) {
            $statement =  $con->prepare("DELETE FROM categories WHERE ID =:zid ");
            $statement->bindParam(":zid", $cat_id);
            $statement->execute();
            $errorMsg = "<div class='alert alert-success '>" . $statement->rowCount() . " record Delete" . "</div>";
            redirectHome($errorMsg);
        } else {
            $errorMsg =  " <div class='alert alert-danger'>Error No Such Id </div>";
            redirectHome($errorMsg, 5);
        }
    }

    include $tmpl . 'footer.php';
} else {

    header('Location: index.php'); // redirect to dashboard
    exit();
}
ob_end_flush();
