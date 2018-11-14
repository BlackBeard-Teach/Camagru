<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> UpdateUser </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="head">
    <h2>Welcome to Camagru</h2>
      
     <a class="signupPopup" href="logout.php" title="Logout">Logout<span></span></a>
     <a class="signupPopup" href="Gallery.php" title="View Gallery">View Gallery<span></span></a>
     <a class="signupPopup" href="home.php" title="HOME">HOME<span></span></a>
    </div>

    <div class="header">
    
    <h1>Update Username</h1>
</div>
<form method="post" action="usernames.php">
        <div class="input-group">
        <label>Old Username</label>
        <input type="text" name="oldUsername" placeholder="old Username" required>
</div> 
   
<div class="input-group">
    <label> New Username </label>
    <input type="text" name="newUsername" placeholder="New Username" required >
       

<div class="input-group">
    <button  type="submit"  class="btn" name="UpdateUser">Update Username</button>
</div>
   
    <?php
					if(isset($_SESSION['t'])){
                        echo $_SESSION['t'];
					$_SESSION['t'] = null;
					}
                    ?>
   



</form>
<hr>
<?PHP 
include ('footer.php');?>
</body>
</html>
