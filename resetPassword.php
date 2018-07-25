<?php

include "dbConnection.php";
include "sha256hash.php";

$username = $_POST['username'];
$password = hash('sha256',"password");

$resetQuery = "UPDATE users SET password = '$password' WHERE user = '$username'";
$conn->query($resetQuery);

$deleteQuery = "DELETE FROM requests WHERE username = '$username'";
$conn->query($deleteQuery);

header("Location: notifications.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

