<?php
session_start();

$pageTitle = 'Login';
if (isset($_SESSION['login'])) {
    header('Location: index.php'); // redirect to dashboard
}
include 'config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// check if user coming from http post request

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashedPassword = sha1($password);

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // check if user exist in database or not
        $statement = $con->prepare("SELECT 
                                UserID, Username, Password 
                                FROM 
                                users 
                                WHERE 
                                Username =? 
                                AND 
                                Password = ?
                                LIMIT 1");
        $statement->execute(array($username, $hashedPassword));
        $row = $statement->fetch();
        $count = $statement->rowCount();
        if ($count > 0) {
            $_SESSION['login'] = $_POST['username']; //register session name
            $_SESSION['ID'] = $row['UserID']; // Register session ID 
            header('Location: index.php'); // redirect to dashboard
            echo "Welcome to dashboard";
            exit();
        } else {
            // Username doesn't exist, display a generic error message
            $login_err = "Invalid username or password.";
        }
    }
    // if count > 0 that mean the database contain  record about this user 


}

?>

<form class="login" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" style="display: flex;flex-direction: column;flex-wrap: nowrap;align-content: center;justify-content: center;align-items: center;">
    <!--TO SEND DATA TO THE SAME SITE -->
    <h2 class="login_head"> Login</h2>
    <div class="form-group">

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <label>Username</label>
        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="">
        <span class="invalid-feedback"><?php echo $username_err; ?></span>
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
        <span class="invalid-feedback"><?php echo $password_err; ?></span>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Login">
    </div>
    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
</form>

<?php
include $tmpl . 'footer.php';
?>