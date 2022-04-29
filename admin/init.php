<?php

include 'connect.php';
// Routes
$tmpl = "./includes/templates/"; //Directory for template
$func = "includes/functions/"; //Directory for functions
$css = "themes/css/"; //Directory for css
$js = "themes/js/"; //Directory for js
$languages = "../admin/includes/languages/"; // languages directory

//  include the important file

include $func . 'functions.php';
include $languages . 'en.php';
include $tmpl . 'header.php';
// include navbar on all pages expect the page that contain $NoNavBar variable

if (!isset($NoNavBar)) {
    include $tmpl . 'navbar.php';
}
