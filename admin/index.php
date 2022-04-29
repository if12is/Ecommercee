<?php
session_start();
$NoNavBar = '';
$pageTitle = 'Login';
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php'); // redirect to dashboard
}

include 'init.php';



// check if user coming from http post request

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['user'];
    $password = $_POST['password'];
    $hashedPassword = sha1($password);

    // check if user exist in database or not

    $statement = $con->prepare("SELECT 
                                UserID, Username, Password 
                                FROM 
                                users 
                                WHERE 
                                Username =? 
                                AND 
                                Password = ?
                                AND 
                                GroupID = 1 
                                LIMIT 1");
    $statement->execute(array($username, $hashedPassword));
    $row = $statement->fetch();
    $count = $statement->rowCount();

    // if count > 0 that mean the database contain  record about this user 

    if ($count > 0) {
        $_SESSION['user'] = $username; //register session name
        $_SESSION['ID'] = $row['UserID']; // Register session ID 
        header('Location: dashboard.php'); // redirect to dashboard
        exit();
    }
}

?>

<form class="login" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <!--TO SEND DATA TO THE SAME SITE -->
    <h2 class="login_head">Admin Login</h2>
    <input class="form-control" type="text" name="user" placeholder="User Name" autocomplete="off" />
    <input class="form-control" type="password" name="password" name="pass" placeholder="Password" autocomplete="new-password" />
    <input class="btn btn-success btn-block" type="submit" name="submit" value="Login" />
</form>

<?php
include $tmpl . 'footer.php';
?>