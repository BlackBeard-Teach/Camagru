<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> UpdateMail </title>
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
    
  	<h1>Update Mail</h1>
  </div>

<form method="post" action="updateMail.php">
        <div class="input-group">
        <label>Old Email</label>
        <input type="text" name="oldMail" placeholder="old Email" required>
</div> 
   
<div class="input-group">
    <label> New Email</label>
    <input type="text" name="newMail" placeholder="New Email"  required >
       

<div class="input-group">
    <button  type="submit"  class="btn" name="UpdateMail">Update Email</button>
</div>
   
    <?php
					if(isset($_SESSION['y'])){
                        echo $_SESSION['y'];
					$_SESSION['y'] = null;
					}
                    ?>
   



</form>
<hr>
<?PHP 
include ('footer.php');?>
</body>
</html>
