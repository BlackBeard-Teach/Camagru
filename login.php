<?php session_start();?>
<!DOCTYPE html>
<html>
    <head>
   
        <title> Register </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>


  <?php include('head.php');?>

<form method="post" action="signin.php">
        <div class="input-group">
        <label>Username</label>
        <input type="text" name="Username" placeholder="Username" required>
</div> 
   
<div class="input-group">
    <label> Password </label>
    <input type="password" name="Password" placeholder="Password" required>
</div>

<div class="input-group">
    <button  type="submit"  class="btn" name="Login" >Login</button>
</div>
    <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
    <?php
					if(isset($_SESSION['er'])){
                        echo $_SESSION['er'];
					$_SESSION['er'] = null;
					}
                    ?>
   

<p>
   Forgot Password? <a href="reset.php">Reset</a>
</p>

</form>
<hr>
<?PHP 
include ('footer.php');?>
</body>
</html>


    
    