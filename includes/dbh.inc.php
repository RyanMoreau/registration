<?php

// Local install
// Make sure loginsystem.sql.zip has been installed
$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "loginsystem";

$conn = mysqli_connect(
    $dbServerName,
    $dbUserName,
    $dbPassword,
    $dbName
);