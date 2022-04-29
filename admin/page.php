<?php

/*
------------------------------------------------
    Categories => [ Mange | Edit | Update | Add | Insert | Delete | Stats ]
------------------------------------------------
 */

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

// if the page is main page

if ($do == 'Manage') {

    echo 'Welcome in manage page ';
} elseif ($do == 'Add') {

    echo 'Welcome in add page ';
} elseif ($do == 'Insert') {

    echo 'Welcome in Insert page ';
} else {
    echo 'ERROR 404 ';
}
