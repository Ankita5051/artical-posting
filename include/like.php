<?php
include 'conn.php';
$a_id=$_GET['id'];
$liker_id=$_SESSION['id'];
//echo($a_id);
$sql="SELECT id from alike where a_id=$a_id and u_id=$liker_id";
$res=mysqli_num_rows(mysqli_query($con,$sql));
echo($res);
if($res)
{
    echo("if");
    $i=mysqli_query($con,"DELETE  FROM alike where a_id=$a_id and u_id=$liker_id");
    $sqlu="UPDATE article set nlike='nlike-1' where id='$a_id'";
$res1=mysqli_query($con,$sqlu);
print_r($res1);
if($res1)
 header("location:../post.php?color=0");
  // echo("return dislike");
}
else{
    echo("else");
   $i=mysqli_query($con,"INSERT INTO alike(a_id,u_id) VALUES($a_id,$liker_id)");
$sqlu="UPDATE article set nlike='nlike+1' where id='$a_id'";
$res1=mysqli_query($con,$sqlu);
print_r($res1);
if($res1)
header("location:../post.php");
//echo("return like");
else
echo("erro");
}
?>