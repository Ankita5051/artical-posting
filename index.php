
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>social app</title>
    <link rel="stylesheet" href="include/styles.css">
  
</head>
<body onload="loadfun()">
    <div class="header">
        <a href="index.php"class="brand">social app</a>
        <ul class="header-list">
            <li><a href="index.php">Home</a> </li>
            <li  id="l-btn">login </li>
        </ul>
    </div>
<div class="banner">
    
    <div id="banner-containt">
    <h1>Welcome In social app</h1>
    <p>Lets get connected with your freinds and family.</p>
    <a id="s-btn"class="signup-btn" href="#">Sign Up</a>


    <?php
	if(isset($_GET['error'])):?>
	<p><?php echo $_GET['error']; ?></p>
	<?php endif ?>
    </div>
    <div id="signup"class="detail " >
    
    <h1>Sign Up</h1>
    <p>Please enter your details to Sign Up</p>
    <form action="include/signup.php"  method="post"class="form">
        <label for="name" class="sinl">
    Username: &nbsp;
    <input type="text" name="username" class="sinput" required="true"></label>
    <label for="age" class="sinl">
    Age: &nbsp;
    <input type="number" name="age" class="sinput" required="true"></label>

    <label for="address" class="sinl">
   Address: &nbsp;
    <input type="text" name="address" class="sinput" required="true"></label>
     <label for="password" class="sinl">
    Password: &nbsp; 
    <input type="password" name="pass" class="sinput" required="true"></label>
    <label for="gender" class="sinl">

    Gender: 
    <span>
    &nbsp; &nbsp; Female<input type="radio" name="gender" id="gender"class="sinput" value="female" required="true">
    &nbsp; Male<input type="radio" name="gender" id="gender" class="sinput" value="male" required="true">
    </span></label>
   
    <button class="signup-btn" name="action" value="signup"type="submit">Sign Up</button>

    </form>
    </div>

    <div id="login"class="detail" >
    <h1>login</h1>
    <p>Please enter your details to login</p>
    <form action="include/signup.php"  method="post"class="form">
        <label for="name">
    Username: &nbsp;
    <input type="text" name="username" class="sinput" required="true"></label>
    <label for="password">
    Password: &nbsp; 
    <input type="password" name="pass" class="sinput" required="true"></label>
    <button class="signup-btn" name="action" value="login"type="submit">login</button>
    </form>
    </div>
    <div class="banner-img">
    </div>
</div>
<script src="include/scripts.js"></script>
</body>
</html>