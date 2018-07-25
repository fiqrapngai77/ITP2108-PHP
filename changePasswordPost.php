<?php
include 'dbConnection.php';
include 'sha256hash.php';

$username = $_SESSION['currentUser'];
$oldPassword = hash('sha256',$_POST['currentPassword']);
$newPassword = hash('sha256',$_POST['newPassword']);
$cPassword =  hash('sha256',$_POST['confirmPassword']);

$existQuery = "SELECT * FROM users WHERE user='$username'";
$existResult = $conn->query($existQuery);

if ($existResult->num_rows > 0){
    $updateQuery = "UPDATE users SET password = '$newPassword' WHERE user = '$username'";
    $conn->query($updateQuery);
    
    header("location: cameras.php");
}
?>