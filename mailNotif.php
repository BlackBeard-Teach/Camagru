<?php session_start();?>
<!DOCTYPE html>
<html>

    <head>
   
        <title> Login </title>
        <meta name="viewport" content="width=device-width initial-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="head">
    <h2>Welcome to Camagru</h2>
     <a class="signupPopup" href="logout.php" title="logout">Logout<span></span></a>
     <a class="signupPopup" href="Gallery.php" title="View Gallery">View Gallery<span></span></a>
     <a class="signupPopup" href="home.php" title="HOME">HOME<span></span></a>
     <?php echo '<br>'. $_SESSION['username']; ?>
    </div>

<? include ('head.php');?>

<form action="notif.php" method="post">
  <p>Do You want to recieve notifications from comments </p>
  <input type="radio" name="check" value="Yes"> Yes <br>
  <input type="radio" name="check" value="No"> No
  <p><input type="submit" name="submit" value="submit"></p>

<?php
					if(isset($_SESSION['notif'])){
                        echo $_SESSION['notif'];
					$_SESSION['notif'] = null;
					}
                    ?>
<hr>
<?PHP 
include ('footer.php');?>
</form>
</body>
</html>