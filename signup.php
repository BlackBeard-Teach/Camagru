<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <meta charset="UTF-8">
    <title>SIGN_UP</title>
  </header>
  <body>
    <?php include('head&foot/header.php') ?>
    <?php include('head&foot/footer.php') ?>
    <div id="login">
      <div class="title">SIGNUP</div>
      <div id="blue">
        <form method="post" style="position: relative;" action="forms/signup.php">
          <label>Email: </label>
          <input id="mail" name="email" placeholder="email" type="mail">
          <label>Username: </label>
          <input id="name" name="username" placeholder="username" type="text">
          <label>Password: </label>
          <input id="password" name="password" placeholder="password" type="password">
          <input name="submit" type="submit" value=" Submit ">
          <span>
            <?php
            echo $_SESSION['error'];
            $_SESSION['error'] = null;
            if (isset($_SESSION['signup_success'])) {
              echo "Registration successful. Verification link sent to your email.";
              $_SESSION['signup_success'] = null;
            }
            ?>
          </span>
        </form>
      </div>
    </div>
  </body>
</HTML>
