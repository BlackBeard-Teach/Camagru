<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Reset </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="head">
	
	<h2>Welcome to Camagru</h2>
	<a class="signupPopup" href="login.php" title="Login"><h1>Login</h1><span></span></a>
	<h3>Reset Password </h3>
	
	</div>
	
<div class="reset">

	
	</div>	
	<form method="post" action="forgot.php">
		<div class="Reset-Email">
		<div class="input-group">
       <label>Email</label>
       <input type="text" name="Email" placeholder="Email" required>
</div>
		</div>
		<div class="cd">
			<button type="submit" name="submit" class="btn">Submit</button>
		</div>
		<div class="ef">
		<span>
			<h4>
					</h4>
		</span>
		<?php
					if(isset($_SESSION['success'])){
                        echo $_SESSION['success'];
					$_SESSION['success'] = null;
					}else{
						echo $_SESSION['err'];
					$_SESSION['err'] = null;
					}
				?>	
		<p>
			Not yet a member ?<a href="index.php">Join now</a>
		</p>
	</div>
	</form>
	</div>
</body>
</html>
