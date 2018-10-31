<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <meta charset="UTF-8">
    <title>CAMAGRU</title>
  </header>
  <body>
    <?php include('head&foot/header.php') ?>
    <?php include('head&foot/footer.php') ?>
    <div id="login">
      <div class="title">LOGIN</div>
      <div id="blue">
        <?php if(isset($_SESSION['id'])) { ?>
          You are connected as <?php print_r(htmlspecialchars($_SESSION['username'])) ?>
        <?php } else { ?>
        <form method="post" style="position: relative;" action="forms/login.php">
          <label>Email: </label>
          <input id="mail" name="email" placeholder="email" type="mail">
          <label>Password: </label>
          <input id="password" name="password" placeholder="password" type="password">
          <input name="submit" type="submit" value=" Submit ">
          <a href="signup.php">Create account</a>
          <a href="forgot.php">Forget password ?</a>
          <span>
            <?php
				if ($_SESSION['error']) {
					echo $_SESSION['error'];
				}
              $_SESSION['error'] = null;
            ?>
          </span>
        </form>
        <?php } ?>
      </div>
    </div>
  </body>
</HTML>
