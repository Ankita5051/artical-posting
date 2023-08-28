<?php
require 'conn.php';

if(!isset($_SESSION['username'])){
    header("location:../index.php");
}
$user=$_SESSION['username'];
$id=$_SESSION['id'];

$article=$_POST['article'];
$sql1="INSERT INTO article(sender_id,artice) VALUES ('$id','$article')";
$result=mysqli_query($con,$sql1);
if($result)
{
$em="posted successfully";
header("location:../post.php?error=$em");
}
else{
$em="some erroe occured";
header("location:../post.php?error=$em");
}
?>