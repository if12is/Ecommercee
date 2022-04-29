<?php

function getTitle()
{
    global $pageTitle;

    if (isset($pageTitle)) {
        echo $pageTitle;
    } else {
        echo "Default";
    }
}


/*
----------------------------------------------------------------
** Redirect function [this function accept parameters]
** $massage
** $seconds = seconds before redirecting
----------------------------------------------------------------
*/

function redirectHome($massage, $url = null, $seconds = 3)
{
    if ($url == null) {
        $url = "index.php";
        $link = 'Home Page';
    } else {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
            $url = $_SERVER['HTTP_REFERER'];
            $link = 'previous Page';
        } else {
            $url = "index.php";
            $link = 'Home Page';
        }
    }
    echo $massage;
    echo "<div class='alert alert-info'>" . "You will be redirected to the $link after {$seconds} seconds." . "</div>";
    header("refresh:$seconds,url=$url");
    exit();
}
/*
* check if the item exists in the database or not
*/

function isItemExists($item, $table, $value)
{
    global $con;
    $stmt = $con->prepare("SELECT $item FROM $table WHERE $item = ?");
    $stmt->execute(array($value));
    $count = $stmt->rowCount();
    return  $count;
}

// function to count items in the database

function countItems($value, $table)
{
    global $con;
    $stat = $con->prepare("SELECT count($value) FROM $table");
    $stat->execute();
    return $stat->fetchColumn();
}

// get latest

function getLatest($select, $table, $order, $limit = 5)
{
    global $con;
    $getStat = $con->prepare("SELECT $select FROM $table ORDER BY $order DESC LIMIT $limit");
    $getStat->execute();
    return $getStat->fetchAll();
}
