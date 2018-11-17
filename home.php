<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="head">
    <h2>Welcome to Camagru <?php echo  '<br>'.$_SESSION['username'] ; ?></h2>
   


    <!--<a class="signupPopup" href="Logout.php" title="Logout">Logout<span></span></a>
    <a class="signupPopup" href="edit_profile.php" title="Logout">Edit profile<span></span></a>
     <a class="signupPopup" href="Gallery.php" title="View Gallery">View Gallery<span></span></a>
     <form method="post" action="cam.php"><input name="call cam" type="submit" value=" Take Pic "></form>
     <script src="cam.js"></script>

    </div>
    <div class="header">-->
    
    <nav>
        <ul>
        <li><a href="logout.php">Logout</a></li>
        <li> <a href="#"> Edit Profile </a>
                <ul>
                <li> <a href="update_password.php">Password</a></li>
                <li> <a href="editUsername.php">Usernames</a></li>
                <li> <a href="editMail.php">Change Email</a></li>
                <li> <a href="mailNotif.php">Mail Notification</a></li>
                </ul>
            </li>
        <li><a href="home.php"> HOME </a></li>
           
           
        </ul>
    </nav>
    
</div> 
 
</body>
</html>


    
         
