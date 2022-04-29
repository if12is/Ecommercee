<?php
ob_start();
session_start();

$pageTitle = 'Dashboard';

if (isset($_SESSION['user'])) {
    include 'init.php';
    // Start dashboard

?>
    <div class="container">
        <div class="text-center head_form_edit"> Dashboard</div>
        <div class="total_num">
            <div class="row">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow  bg-body rounded h-200 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Members
                                    </div>
                                    <div class="h5 mb-0 num font-weight-bold text-gray-800">
                                        <a href="members.php" class="num_member"><?php echo countItems('UserID', 'users') ?></a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-circle text-primary fs-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow  bg-body rounded h-200 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Pending Members
                                    </div>
                                    <div class="h5 mb-0 num font-weight-bold text-gray-800">
                                        <a href="members.php?do=Manage&page=pending" class="num_member">
                                            <?php echo isItemExists('RegStatus', 'users', 0) ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-circle text-success fs-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow  bg-body rounded h-200 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Items
                                    </div>
                                    <div class="h5 mb-0 num font-weight-bold text-gray-800">
                                        <a href="items.php" class="num_member"><?php echo countItems('Item_Id', 'items') ?></a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-barcode text-info fs-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow  bg-body rounded h-200 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Comments
                                    </div>
                                    <div class="h5 mb-0 num font-weight-bold text-gray-800">
                                        <a href="comments.php" class="num_member"><?php echo countItems('c_id', 'comments') ?></a>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comment-alt text-warning fs-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container latest">
        <div class="row">
            <div class="col-md-6">
                <?php $latestUser = 5;
                $TheLast = getLatest("*", "users", "UserID", $latestUser);
                ?>
                <div class="card shadow bg-body rounded latest_user_table ">
                    <div class="card-header text-dark bg-info mb-3 text-uppercase fw-bold">
                        <i class="fa fa-user text-secondary"></i> Latest <?php echo $latestUser; ?> Registers Users
                        <span class="toggle_info float-end">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush latest_user">
                            <?php
                            foreach ($TheLast as $user) {
                                echo "<li class='list-group-item fw-bold'>";
                                echo $user['Username'];
                                echo "<a href='members.php?do=Edit&userId=" . $user['UserID'] . " '>";
                                echo "<span class='btn btn-sm btn-success float-end'>";
                                echo "<i class='fas fa-edit'></i>  Edit ";
                                if ($user['RegStatus'] == 0) {
                                    echo   "<a href='members.php?do=Activate&userId=" . $user['UserID'] . " 'class='btn float-end me-md-3 btn-sm btn-cyan btn_activate'><i class='fas fa-check-square'></i> Activate</a>";
                                }
                                echo "</span>";
                                echo "</a>";
                                echo "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php $latestItem = 5;
                $TheLast = getLatest("*", "items", "Item_ID", $latestItem);
                ?>
                <div class="card shadow bg-body rounded latest_user_table ">
                    <div class="card-header text-dark bg-info mb-3 text-uppercase fw-bold">
                        <i class="fa fa-user text-secondary"></i> Latest <?php echo $latestItem; ?> Items
                        <span class="toggle_info float-end">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush latest_user">
                            <?php
                            foreach ($TheLast as $item) {
                                echo "<li class='list-group-item fw-bold'>";
                                echo $item['Name'];
                                echo "<a href='items.php?do=Edit&itemId=" . $item['Item_ID'] . " '>";
                                echo "<span class='btn btn-sm btn-success float-end'>";
                                echo "<i class='fas fa-edit'></i>  Edit ";
                                if ($item['Approve'] == 0) {
                                    echo   "<a href='items.php?do=Approve&itemId=" . $item['Item_ID'] . " 'class='btn float-end me-md-3 btn-sm btn-cyan btn_activate'><i class='fas fa-check-square'></i> Approve</a>";
                                }
                                echo "</span>";
                                echo "</a>";
                                echo "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-2 mb-2 ">
            <div class="col-md-12 ">
                <?php $NumComment = 5;
                $TheLast = getLatest("*", "comments", "c_id", $NumComment);
                ?>
                <div class="card shadow bg-body rounded latest_user_table ">
                    <div class="card-header text-dark bg-info text-uppercase fw-bold">
                        <i class="fas fa-comment-dots text-secondary"></i> Latest <?php echo $NumComment; ?> Last Comment
                        <span class="toggle_info float-end">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush latest_user">
                            <?php
                            $statement = $con->prepare("SELECT
                                 comments.*,Users.Username
                                 FROM
                                 comments
                                 INNER JOIN
                                 users
                                 ON
                                 users.UserID = comments.user_id
                                 ORDER BY c_id DESC
                                 LIMIT $NumComment
                                 ");
                            $statement->execute();
                            $comments = $statement->fetchAll();
                            foreach ($comments as $comment) {

                                echo " <section style='background-color: #e7effd;'>";
                                echo "<div class='container mt-2 text-dark'>";
                                echo "<div class='row d-flex justify-content-center'>";
                                echo "<div class='col-md-11 col-lg-9 col-xl-7'>";
                                echo "<div class='d-flex flex-start mb-4'>";
                                echo "<img class='rounded-circle shadow-1-strong me-3' src='https://www.pngarts.com/files/5/Cartoon-Avatar-PNG-Photo.png' alt='avatar' width='65' height='65' />";
                                echo "<div class='card w-100'>";
                                echo "<div class='card-body p-4'>";
                                echo "<div class='p-3'>";
                                echo "<div class='head_comm'><h5>" . $comment['Username'] . " </h5> ";
                                if ($comment['status'] == 0) {
                                    echo "<span class='badge bg-warning mx-1'>Not Approved</span>";
                                } else {
                                    echo "<span class='badge bg-primary mx-1'>Approved</span>";
                                }
                                echo " </div> ";
                                echo "<p class='small'>";
                                // $now = new DateTime(); //now
                                // $date_info = date("Y-m-d", strtotime($comment["comment_date"]));
                                // echo $date_info;
                                echo $comment["comment_date"];

                                echo "</p>";
                                echo "<p>" . $comment['comment'] . "</p>";

                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</section>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    // End dashboard
    include $tmpl . 'footer.php';
} else {
    header('Location: index.php'); // redirect to dashboard
    exit();
}
ob_end_flush();
?>