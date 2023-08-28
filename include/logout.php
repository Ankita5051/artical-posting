<?php
include 'conn.php';
$user=$_SESSION['username'];
if(!isset($_SESSION['username'])){
    header("location:../logout.php?error='session expired'");
}

session_destroy();
header("location:../logout.php");
?>

