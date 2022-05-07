<?php

include 'conn.php';
// Routes
$tmpl = "includes/templates/"; //Directory for template
$func = "admin/includes/functions/"; //Directory for functions
$css = "themes/css/"; //Directory for css
$css_boot = "themes/bootstrap/css/"; //Directory for css for bootstrap
$img = "themes/img/"; //Directory for img
$js = "themes/js/"; //Directory for js
$font = "themes/font/"; //Directory for font
$js_boot = "themes/bootstrap/js/"; //Directory for js bootstrap
$languages = "admin/includes/languages/"; // languages directory

//  include the important file

include $func . 'functions.php';
include $languages . 'en.php';
include $tmpl . 'header.php';

// include navbar on all pages expect the page that contain $NoNavBar variable

include $tmpl . 'navbar.php';
