<?php
require 'include/conn.php';
if(!isset($_SESSION['username'])){
    header("location:index.php");
   }
   else
   $user=$_SESSION['username'];
   $id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>social app</title>
    <link rel="stylesheet" href="include/styles.css">
    <style>
     
    </style>
</head>
<body>
<div id="userhome">
        <a href="index.php"class="brand">welcome  <?php echo $_SESSION['username']; ?></a>
        
    </div>

	
	<p class="log">logged in as: <?php echo $_SESSION['username']; ?></p>

	<div class="uh-list">
	<ul >
            <li><a href="home.php"> Home</a></li>
            <li  onclick="edit_profile()"> Edit Profile</li>
			<li><a href="freind.php">freinds</a> </li>
			<li><a href="member.php"> members</a></li>
            <li><a href="request.php"> requests</a></li>
            <li><a href="post.php">articles</a></li> 
			<li><a href="include/logout.php">logout</a> </li>

        </ul>
	</div>
    <h1 style="text-align:center;">Friends</h1>
    <table class="member">
        <tr class="mem-row">
        <th class="table-head">profile</th>
        <th class="table-head">status</th>
        <th class="table-head">option</th>
    </tr>
    <?php
   
   //freinds
   $sql="SELECT members.id,username,img_url,about,status from freind,members where status='freind' and((user_id='$id' and members.id=frend_id) or (frend_id='$id' and members.id=user_id))";
   $res=mysqli_query($con,$sql);
   $status="freinds";
   while($row=mysqli_fetch_array($res)){
       ?>
        <tr class="mem-row">
       <td class="profile-cell">
           <div class="wrapper">
               <img src="../../uploads/<?=$row['img_url']?>" alt="" class="demo-img" srcset=""> 
               <div class="wrap-detail"> 
                   <h3><?php echo $row['username']?> </h3> <p> <?php echo $row['about']?></p>
           </div>
            </div>
            </td>
               
       <td class="member-cell">freinds</td>
           <td class="member-cell">
           <?php if($status=='freinds' || $status=='following') { ?> 
               <button class="status-btn" onclick="unfollow(<?php  echo $row['id']; ?>)">Unfollow</button>
                <?php } else { ?>
                     <button class="status-btn" onclick="request(<?php echo $row['id']; ?>)">Follow</button>
                     <?php } ?>
                   </td>
       </tr>
       <?php
   }
   //following
   
   $sql="SELECT distinct(members.id),username,img_url,about,status from freind,members where status='following' and user_id='$id' and members.id=frend_id";
   $res=mysqli_query($con,$sql);
   $status="following";
   while($row=mysqli_fetch_array($res)){
       ?>
        <tr class="mem-row">
       <td class="profile-cell">
           <div class="wrapper">
               <img src="../../uploads/<?=$row['img_url']?>" alt="" class="demo-img" srcset=""> 
               <div class="wrap-detail"> 
                   <h3><?php echo $row['username']?> </h3> <p> <?php echo $row['about']?></p>
           </div>
            </div>
            </td>
               
       <td class="member-cell">following</td>
           <td class="member-cell">
           <?php if($status=='freinds' || $status=='following') { ?> 
               <button class="status-btn" onclick="unfollow(<?php  echo $row['id']; ?>)">Unfollow</button>
                <?php } else { ?>
                     <button class="status-btn" onclick="request(<?php echo $row['id']; ?>)">Follow</button>
                     <?php } ?>
                   </td>
       </tr>
       <?php
   }
   
   //followers
   $sql="SELECT distinct(members.id),username,img_url,about,status from freind,members where status='following' and frend_id='$id' and members.id=user_id";
   $res=mysqli_query($con,$sql);
   $status="follower";
   while($row=mysqli_fetch_array($res)){
       ?>
        <tr class="mem-row">
       <td class="profile-cell">
           <div class="wrapper">
               <img src="../../uploads/<?=$row['img_url']?>" alt="" class="demo-img" srcset=""> 
               <div class="wrap-detail"> 
                   <h3><?php echo $row['username']?> </h3> <p> <?php echo $row['about']?></p>
           </div>
            </div>
            </td>
               
       <td class="member-cell">follower</td>
           <td class="member-cell">
           <?php if($status=='freinds' || $status=='following') { ?> 
               <button class="status-btn" onclick="unfollow(<?php  echo $row['id']; ?>)">Unfollow</button>
                <?php } else { ?>
                     <button class="status-btn" onclick="request(<?php echo $row['id']; ?>)">Follow</button>
                     <?php } ?>
                   </td>
       </tr>
       <?php
   }


?>
    </table>
</body>
<script src="include/scripts.js"></script>
</html>