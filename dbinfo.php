<?php
session_start();
/*
declare db connectivity information
in an external file to make it
easier to retrieve and maintain
*/
$dbhost	= "localhost";
$dbuser	= "jayowl";
$dbpass	= "joelssd";
$dbname	= "bcit";

// mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("MySQL Error: " . mysql_error());
// mysqli_select_db($dbname, 'bcit') or die("MySQL Error: " . mysql_error($dbname));

// 1. Create a database connection
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection) {
    die("Database connection failed: " . mysqli_error());
}

// 2. Select a database to use 
$db_select = mysqli_select_db($connection, $dbname);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error());
}
?>
?>
