<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Register </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="head">
    <h2>Welcome to Camagru</h2>
    <a class="signupPopup" href="login.php" title="Login">Login<span></span></a>
     <a class="signupPopup" href="Gallery.php" title="View Gallery">View Gallery<span></span></a>
    
    </div>
    <div class="header">
    
  	<h1>Register</h1>
  </div>
<form method="POST" action="signup.php">
        <div class="input-group">
        <label>Username</label>
        <input type="text" name="Username" placeholder="Username" required>
</div> 
   <div class="input-group">
       <label>Email</label>
       <input type="text" name="Email" placeholder="Email" required>
</div>
<div class="input-group">
    <label> Password </label>
    <input type="password" name="Password" placeholder="Password" required>
</div>
<div class="input-group">
    <label>Confirm Password</label>
    <input type="password" name="cPassword" placeholder="Confirm Password" required>
</div>

<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

<div class="input-group">
    <button  type="submit"  class="btn" name="Register" >Register <br></button>
    <?php
					if(isset($_SESSION['signup_success'])){
                        echo "Registration successful. Verification link sent to your email.";
					$_SESSION['signup_success'] = null;
					}else{
						echo $_SESSION['error'];
					$_SESSION['error'] = null;
					}
				?>
</div>
</form>
<hr>

<?PHP 
</body>
</html>


    
         
