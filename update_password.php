<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
   
        <title> HOME </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


<div id="head">
    <h2>Welcome to Camagru</h2>
      
     <a class="signupPopup" href="logout.php" title="logout">Logout<span></span></a>
     <a class="signupPopup" href="Gallery.php" title="View Gallery">View Gallery<span></span></a>
     <a class="signupPopup" href="home.php" title="HOME">HOME<span></span></a>
    </div>
    <div class="header">
    
  	<h1>Update Password</h1>
  </div>

<form method="post" action="change_pass.php?">
<div class="input-group">
        <label>Old Password</label>
        <input type="password" name="oPassword" placeholder="Old Password" required>
</div> 
        <div class="input-group">
        <label>Password</label>
        <input type="password" name="Password" placeholder="New Password" required>
</div> 
   
<div class="input-group">
    <label> Confirm Password </label>
    <input type="password" name="cPassword" placeholder="Confirm Password" required>
</div>

<div class="input-group">
    <button  type="submit"  class="btn" name="Update" >Update</button>
</div>
    
    <?php
					if(isset($_SESSION['f'])){
                        echo $_SESSION['f'];
					$_SESSION['f'] = null;
					}
                    ?>
   

</form>
<hr>
<?PHP 
include ('footer.php');?>
</body>
</html>

