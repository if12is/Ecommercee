<?php
ob_start();

session_start();
$pageTitle = '';

if (isset($_SESSION['user'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {
        echo 'Welcome';
    } elseif ($do == 'Add') {
    } elseif ($do == 'Insert') {
    } elseif ($do == 'Edit') {
    } elseif ($do == 'Update') {
    } elseif ($do == 'Delete') {
    } elseif ($do == 'Activate') {
    }
    include $tmpl . 'footer.php';
} else {

    header('Location: index.php'); // redirect to dashboard

    exit();
}
ob_end_flush();
