<?php
// Initialize the session
session_start();
include 'config.php';

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("location: login.php");
    exit;
}

?>


<div class="container">
    <h1 class="my-5">Hi, <b></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
</div>