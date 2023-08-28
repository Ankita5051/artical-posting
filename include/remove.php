<?php
require 'conn.php';
if(!isset($_SESSION['username']))
{
    header("location:../index.php");
   }
   
   $user=$_SESSION['username'];
   $id=$_SESSION['id'];
   $a_id= $_GET['id'];
   echo($a_id);
   $sql="DELETE from alike where a_id=$a_id";
   $res=mysqli_query($con,$sql);
   $sql="DELETE from acomment where a_id=$a_id";
   $res=mysqli_query($con,$sql);
   $sql="DELETE from article where id=$a_id";
   $res=mysqli_query($con,$sql);
   if($res)
   header("location:../post.php?error='deleted successfully'");
   else
   echo("erroe");
   //header("location:../post.php?error='error ocurred'");
   ?>