<?php
require 'include/conn.php';
if(!isset($_SESSION['username'])){
 header("location:index.php");
}
else{
	$user=$_SESSION['username'];
	$id=$_SESSION['id'];
}

?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>social app</title>
		<link rel="stylesheet" href="include/styles.css">
	</head>
	<body>
	<div id="userhome">
        <a href="index.php"class="brand">welcome  <?php echo $_SESSION['username']; ?></a>
    </div>
	<p class="log">logged in as: <?php echo $_SESSION['username']; ?></p>

	<div class="uh-list">
	<ul >
            <li><a href="home.php"> Home</a></li>
            <li id="edit-p"> Edit Profile</li> 
			<li><a href="freind.php">freinds</a> </li>
			<li><a href="member.php"> members</a></li>
			<li><a href="request.php"> requests</a></li>
            <li><a href="post.php">articles</a></li>
			<li><a href="include/logout.php">logout</a> </li>

        </ul>
	</div>

<?php
$sql="SELECT * from members where id='$id'";
$profile=mysqli_fetch_assoc(mysqli_query($con,$sql));
?>
	<h1 style="text-align:center;">Your profile</h1>
	<div id="profile">
	<img src="../../uploads/<?=$profile['img_url']?>" alt="" class="img" srcset="">
	<p class="about"><?php echo $profile['about']; ?> <br/>
	 Gender: <?php echo $profile['gender']; ?><br/>
	 Age: <?php echo $profile['age']; ?><br/>
	 Address: <?php echo $profile['address']; ?> </p>	
	</div>
	<?php
	
	if(isset($_GET['error'])):?>
	<p ><?php set_time_limit(2); echo $_GET['error']; ?></p>
	<?php endif ?>


	<!-- //edit profile -->
	<div id="edit-profile">
		<h1>Edit your detail</h1>
		<form action="include/edit_profile.php" method="post" enctype="multipart/form-data">
			
		<label for="about"> About : &nbsp;&nbsp;	
		<textarea id="e_about"name="about" value="" cols="90" rows="2" ><?php echo $profile['about'];?></textarea></label>

		<label for="profile-img">Profile Image : &nbsp;&nbsp;
		<input type="file" name="profile-img" value="<?php echo $profile['img_url'];?>"></label>
		<label for="age">Age : &nbsp;&nbsp;
		<input type="number" name="age" value="<?php echo $profile['age'];?>"></label>
		<label for="gender">Gender : &nbsp;&nbsp;
		F<input type="radio" name="gender" value="female"
		<?php if($profile['gender']=='female'){?>checked="checked"<?php } ?> />
	M<input type="radio" name="gender" id="" value="male" <?php if($profile['gender']=='male'){?>checked="checked"<?php } ?> ></label>
		<label for="address">Address : &nbsp;&nbsp;
		<input type="text" value="<?php echo $profile['address'];?>"name="address"></label>
		<button id="psave" type="submit" >save</button>
		</form>
	</div>
<script>
	const edit=document.getElementById("edit-p");
const editform=document.getElementById("edit-profile");
//console.log(editform);
edit.onclick=()=>{
  
    editform.style.display="block";
};
</script>
	</body>
	
	</html>