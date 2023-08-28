<?php
include 'conn.php';
$comment=$_POST['comment'];
$uid=$_SESSION['id'];
$a_id=$_GET['id'];
$sql="INSERT INTO acomment(a_id,u_id,comment) VALUES($a_id,$uid,'$comment')";
$res=mysqli_query($con,$sql);
if($res)
header("location:../post.php?error=comment added");
else
header("location:../post.php?error='some error occured'");
?>