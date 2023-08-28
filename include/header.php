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
        <li><a href="post.php">articles</a></li>
			<li><a href="include/logout.php">logout</a> </li>

        </ul>
	</div>
    