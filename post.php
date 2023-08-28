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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="include/styles.css">
    
</head>
<body>
<div id="userhome">
        <a href="index.php"class="brand">welcome <?php echo $_SESSION['username']; ?></a>
        
    </div>
    <p class="log">logged in as: <?php echo $_SESSION['username']; ?></p>
    <div class="uh-list">
	<ul >
            <li><a href="home.php"> Home</a></li>
            <li onclick="edit_profile()"> Edit Profile</li> 
			<li><a href="freind.php">freinds</a> </li>
			<li><a href="member.php"> members</a></li>
            <li><a href="request.php"> requests</a></li>
            <li><a href="post.php">articles</a></li>
			<li><a href="include/logout.php">logout</a> </li>

        </ul>
	</div>
    <h2 style="text-align:center;">ARTICLES</h2>
<?php
	if(isset($_GET['error'])):?>
    
	<p ><?php set_time_limit(2); echo $_GET['error']; ?></p>
	<?php endif ?>

    
    <div class="message">

   
    <!-- post article -->
    <div class="private">
        <h2>post your article.</h2>

        <div class="write">

<div class="you">
<h2><?php echo $user; ?></h2>
<img src="img/profile.png" class="wm-img"alt="">

</div>

<div class="m-form">  
<form action="include/article_post.php" method="post">
<textarea class="m-in" name="article" id="message" cols="8" rows="16" placeholder="type here to post your article" required="true"></textarea>
<button class="m-in" id="send" name="action" value="public" type="submit" > post article</button>
</form>
</div>
    </div>
      
</div>
<div class="read">
        <?php

$sql="SELECT DISTINCT(article.id) as article_id,sender_id,time,artice,username,img_url from article,freind,members where 
(   (user_id=$id and sender_id=frend_id 
        and (status='following' or status='freind')
    ) 
    or (sender_id=user_id and status='freind' and frend_id=$id) 
    or sender_id=$id
) 
and members.id=sender_id 
ORDER BY time desc";
$result=mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result)){
    ?>

<div class="p_post">
    <div class="u-detail">
        <h3>
            <?php 
        if($row['username']==$user)
        echo "You"; 
        else 
        echo  $row['username']; ?>
        </h3>
         <p><?php echo $row['time']; ?></p>
    </div>

    <div class="m-mesg">
        <img src="../../uploads/<?=$row['img_url']?>" class="m-p-img"alt="">
        <div>
        <p><?php echo $row['artice']; ?></p>
      
        </div>
    </div>

    <div id="lcr">
        <!-- like -->
        <span>
        
    <a id="like"href="include/like.php?id=<?php echo($row['article_id']);?>" ><i class="fa-solid fa-heart" style="color:red"></i> &nbsp; liked by: <span>
    
    <?php 
    $a_id=$row['article_id'];
    $res=mysqli_query($con,"SELECT * from alike, members where a_id=$a_id and u_id=members.id ORDER BY CASE WHEN username='$user' THEN 0 ELSE 1 END,
    username ASC");
    $c=mysqli_num_rows($res);
    if(!$c)
    echo 0;
    elseif($c==1) { 
        $oneliker=mysqli_fetch_array($res);
echo($oneliker['username']==$user)?("you"):($oneliker['username']); 
    } 
    
    else {
        $likers=mysqli_fetch_array($res);
    $liker_id=$likers['username'];
    echo($likers['username']==$user)?("you"):($likers['username']);    
    // echo($likers['username']);

    ?> and 
    <?php $btnid="check".$a_id;?>
    <a href="#" id="<?php echo $btnid;?>" onclick="likes(<?php echo $row['article_id'];?>)"> +<?php echo($c-1);?>other </a>
    <?php
    }?>
    </span></a>
    <?php $lbox="likers".$a_id;
    //echo($btnid);
    ?>
    <div class="likers" id="<?php echo $lbox;?>">
        <div class="check-head"><h4>likes</h4> <p onclick="togglebox(<?php echo $row['article_id'];?>)"><i class="fa-solid fa-xmark"></i></p> </div>
    <?php
    while($liker=mysqli_fetch_array($res)){?>
        <div class="liker">
        <img src="../../uploads/<?=$liker['img_url']?>" class="l-img"alt="">
        <p class="l-name"><?php echo ($liker['username']==$user)?("you"):($liker['username']); ?></p>   
        
        </div> 
   <?php }
    ?>
    
</div>
    </span>
    &nbsp;
    <!-- comment icon -->
    <a href="#"> 
    <?php $tglbtn="toggleCommentbox".$a_id;
    //echo($btnid);
    ?>
    <i id="toggleCommentbox <?php echo $tglbtn;?>" onclick="toglCmtbox(<?php echo $a_id;?>)"class="fa-regular fa-comment"></i>
    </a>
    <!-- end commentbtn -->
<!-- remove icon -->
&nbsp;
        <?php 
        if($row['username']==$user){?>
        <a id="remove"href="include/remove.php?id=<?php echo $row['article_id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
        <?php } ?>
<!-- end remove -->
    </div>

    <?php $cmtwrap="commentWrapper".$a_id;
    //echo($btnid);
    ?>
    <div class="commentWrapper" id="<?php echo $cmtwrap;?>">
<form action="include/comment.php?id=<?php echo($row['article_id']);?>" method="post">
<textarea name="comment" id="cbox" placeholder="Add a comment" cols="10" rows="2" required="true"></textarea>
   
    <button type="submit" name="csubmit" value="csubmit" id="c-btn">post</button>
</form>

<div class="displayComments">

<?php
    
    $sql="SELECT * from acomment where a_id=$a_id ORDER BY time desc";
    $res=mysqli_query($con,$sql);
   // print_r($res);
    while($cmnt=mysqli_fetch_array($res)){
        $commentor_id=$cmnt['u_id'];
        $sqlforcommenter="SELECT * FROM members where id=$commentor_id";
        $commentor=mysqli_fetch_array(mysqli_query($con,$sqlforcommenter));
        ?>
        <div class="commentbox">
   

        
   <div class="commenterid">
   <h4 class="c-name"><?php  echo ($commentor['username']==$user)?("you"):($commentor['username']); ?></h4>
   <img src="../../uploads/<?=$commentor['img_url']?>" class="c-img"alt="">
   </div> 
   <div class="comment">
       <p><?php echo($cmnt['comment']);?></p>
       <p><?php echo($cmnt['time']);?></p>
   </div>
   
   </div>
        <?php
    }
    ?>

</div>
</div>
</div>

<?php
}
?>
        </div>
    </div>
<script>
const toglCmtbox=(n)=>{
    btn="commentWrapper"+n;
    console.log(btn);
    const cmtwrap=document.getElementById(btn);
    (cmtwrap.style.display=="block")?cmtwrap.style.display="none":cmtwrap.style.display="block";
}

    const togglebox=(n)=>{
        btn="likers"+n;
        console.log(btn);
        let likebox=document.getElementById(btn);
        likebox.style.display="none";
    };
    const likes=(n)=>{
likebtn="likers"+n;
let btn=document.getElementById(likebtn);
let likebox=document.getElementById(likebtn);
likebox.style.display="block";
console.log(likebtn);
  };
</script>
<script src="include/scripts.js"></script>
</body>
</html>


