<?php
require 'conn.php';
//$usern=mysqli_real_escape_string($con,$_POST['username']);
$username=$_POST['username'];
//filter_var($usern,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
$passs=md5($_POST['pass']);
$pass=filter_var($passs,FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
$action=$_POST['action'];

if($action=='signup')
{
    $gender=$_POST['gender'];
    $address=$_POST['address'];
    $age=$_POST['age'];
   
    $about="hello am ".$username.",";
    $default_img = "profile.png";

    $sql="SELECT username from members where  username='$username'"; 
    $num=mysqli_num_rows(mysqli_query($con,$sql));
  
    if(!$num)
    {   
    $username=strtolower($username);
$sql="INSERT INTO members (username,password,about, img_url,age,address,gender) VALUES ('$username', '$pass', '$about', '$default_img','$age','$address','$gender')";
    $res=mysqli_query($con,$sql);
   
   
    if($res)
    {
     $_SESSION['username']=$username;
   //echo "success";
   $sql="SELECT MAX(id) from members";
   $result = mysqli_fetch_array(mysqli_query($con,$sql));
   print_r( $result);
   $_SESSION['id']=$result[0];
  echo $_SESSION['id'];
  //print_r($result);
  //echo $result[0];
  header("location:../home.php");
    }
    else
    {
        $em="some error occured";
      echo $em;
     header("location:../index.php?error=$em");
    }
    }
    else
    {
   
    $em="This username already exist";
    header("location:../index.php?error=$em");
    }
}
else

if($action=='login')
{
    $sql="SELECT id,password FROM members where username='$username'";
   
    $numr = mysqli_num_rows(mysqli_query($con,$sql));
    //echo $result['password'];
    if(!$numr)
    {
        $em="Invalid username";
        header("location:../index.php?error=$em"); 
    }
else    
    {
        $result = mysqli_fetch_array(mysqli_query($con,$sql));
        if($result['password']!=$pass )
        {
            $em="Incorrect password";
            header("location:../index.php?error=$em");
        }
        else
        {
            
            $_SESSION['username']=$username;
          // echo $_SESSION['username'];
          $_SESSION['id']=$result['id'];
         
           header("location:../home.php");
        }
    }
}
else 
echo "error";

?>