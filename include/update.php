<script>const params = new URLSearchParams(window.location.search);
action = params.get('action');
id=params.get('id');
document.cookie="action="+action;
document.cookie='id='+id;
console.log((action));

</script>
<?php
require 'conn.php';
if(!isset($_SESSION['username']))
{
    header("location:../index.php");
   }
   
   $user=$_SESSION['username'];
   $id=$_SESSION['id'];
$action=$_GET['action'];
$f_id=$_GET['id'];


if($action==1)
{
    $sql="SELECT id from freind where status='request' and user_id=$id and frend_id=$f_id";
    $res=mysqli_num_rows(mysqli_query($con,$sql));
    if($res){
        $em="request sent";
    header("location:../request.php?error=$em");
    }
    else{
    $sql="INSERT INTO freind(user_id,frend_id,status) VALUES($id,$f_id,'request')";
  $res=mysqli_query($con,$sql); 
  if($res){
    $em="request sent";
    header("location:../request.php?error=$em");
  }
  else{
    $em="try again";
    echo($em);
    header("location:../request.php?error=$em");
  }
}
}
elseif($action==0)
    {
        
        $sql="SELECT id,status from freind where (user_id=$id and frend_id=$f_id) or(frend_id=$id and user_id=$f_id)";
        $folwres=mysqli_fetch_array(mysqli_query($con,$sql));
        $row=$folwres['id'];
        echo $row;
        if($folwres['status']=='following')
        {
            $quer="DELETE FROM freind WHERE id=$row";
            $qres=mysqli_query($con,$quer);
            if($qres) 
            header("location:../freind.php");

        }
        else
        {
            echo $folwres['status'];
            if($folwres['status']=='freind')
            {
                $quer="UPDATE freind SET user_id=$f_id ,frend_id=$id , status='following' where id=$row";
                $qres=mysqli_query($con,$quer);
                if($qres)
                header("location:../freind.php");
            }
        }

    }
elseif($action==2)
    {
        $sql="DELETE from freind where frend_id='$f_id' and user_id='$id' and status='request'";
        $res=mysqli_query($con,$sql);
        if($res)
        header("location:../request.php");
        else
        header("location:../request.php?error=some erroe occured");
    }
elseif($action==3){

    $sql="SELECT id from freind where user_id='$id' and frend_id
    =$f_id and status='following'";
    $res=mysqli_query($con,$sql);
    $row=mysqli_fetch_array($res)['id'];
    if($row){
        $sql="DELETE from freind where status='request' and user_id='$f_id' and frend_id
        =$id";
         $res=mysqli_query($con,$sql);

        $sqlu="UPDATE freind SET status='freind' where id=$row";
        $resi=mysqli_query($con,$sqlu);
        if($resi)
        {
            $em="new freinds";
            header("location:../request.php?error=$em");
        }
        else{
            $em="some error occured";
            header("location:../request.php?error=$em");  
        }
    }
    else{
        $sqlu="UPDATE  freind set status='following' where user_id='$f_id' and frend_id
        =$id";
        $resi=mysqli_query($con,$sqlu);
        if($resi)
        {
            $em="one new follower";
            header("location:../request.php?error=$em");
        }
        else{
            $em="some error occured";
            header("location:../request.php?error=$em");  
        }
    }
}



?>