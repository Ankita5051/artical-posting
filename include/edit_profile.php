<?php
require 'conn.php';
$about=$_POST['about'];
$img = $_FILES['profile-img'];
// $name=$_POST['name'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$address=$_POST['address'];
//echo $img['name'];
$user=$_SESSION['username'];
$id=$_SESSION['id'];
$img_name=$img['name'];
$img_size=$img['size'];
$tmp_name=$img['tmp_name'];
$error=$img['error'];
// echo "<pre>";
// print_r($_FILES['profile-img']);
// echo"</pre>";

if(!$error)
{
    if($img_size>625000)
    {
        $em="image size is too large";
        header("location:../home.php?error=$em");
    }
    else
    {
        //echo $about;
        $img_ex =strtolower(pathinfo($img_name,PATHINFO_EXTENSION));
        $allowed_exs=array("jpg","jpeg","png");
        if(in_array($img_ex,$allowed_exs))
        {
            //echo "true";
            $new_img_name = uniqid("img-",true).'.'.$img_ex;           
            $img_upload_path = '../../../uploads/'.$new_img_name;
            
            //insert in db
            $quer="SELECT img_url from members where id='$id'";

            $old_img_url = mysqli_fetch_assoc(mysqli_query($con,$quer));
            
            $sql="UPDATE members SET img_url='$new_img_name' , about='$about',age=$age,address='$address',gender='$gender' where id='$id'";
            $res = mysqli_query($con,$sql) ; 
        
            if($res)
               {
                
                if(strcmp($old_img_url['img_url'],'profile.png'))
                   unlink("../../../uploads/".$old_img_url['img_url']);

               move_uploaded_file($tmp_name,$img_upload_path);
                   $em="your profile is upto date";
                   
         header("location:../home.php?error=$em");
               }
           else
               {
                   $em="unknown error occured while updating";
                   header("location:../home.php?error=$em");
               }
           
        }
        else
        {
            $em="only jpg , png and jpeg type is supported";
            header("location:../home.php?error=$em"); 

        }
    }
}
else
{
   // $sql="UPDATE members SET  about='$about' where username='$user'";
    $sql="UPDATE members SET about='$about',age=$age,address='$address',gender='$gender' where id='$id'";
    $res = mysqli_query($con,$sql) ;  
    if($res)
               {
                
               $em="your profile is upto date";
                   
            header("location:../home.php?error=$em");
               }
           else
               {
                   $em="unknown error occured while updating";
                   header("location:../home.php?error=$em");
               }
}
?>