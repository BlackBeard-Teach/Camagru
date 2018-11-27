
<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'Config/database.php';



htmlspecialchars($_SESSION['username']);

	try
	{
		$Username		= $_SESSION['username'];
		$image_id 		= trim(htmlspecialchars($_POST['image_id']));
		$comment 		= htmlspecialchars($_POST['comment_txt']);

		echo  ".$Username .$comment .$image_id .fe";
		if (!isset($Username) || empty($Username))
		{
			echo "Invalid Username!! <br>";
		}
		else if (!isset($comment) || empty($comment))
		{
			echo "Invalid comment!! <br>";
		}
		else if ((isset($Username) && !empty($Username))
			&& (isset($image_id) && !empty($image_id))
			&& (isset($comment) && !empty($comment))) {
            $dbh = new PDO($DSN_dbname, $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $sql = "USE ".$DB_NAME;
            $sql = $dbh->prepare("INSERT INTO comments (Commenter, comment, image_id)
				VALUES (:Username, :comment, :image_id)");
            $sql->execute(array(':Username' => $Username, ':comment' => $comment, ':image_id' => $image_id));
			mailNotif($image_id, $Username);
			}
	}
		catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
		}
	
		function mailNotif($img_id,$Username) {
			include ('config/database.php');
		
			try {
				$pdo = new PDO($DSN_dbname,$username,$password);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$wat = $pdo->prepare("SELECT * FROM gallery WHERE img_id = $img_id");
			$wat->execute();
			$found = $wat->rowCount();
			while ($row = $wat->fetch(PDO::FETCH_ASSOC)) {
				$name  = $row['username'];
			}
			if ($found == 1)
			{
				checkUser($name, $Username);
				//header("Location: home.php");
			}
			else{
				header("Location: index.php");
			}
		}catch(PDOexception $e)
		{
            echo $sql . "<br>" . $e->getMessage();
		}

	}
	function checkUser($name, $Username) {
		include ('config/database.php');
		try {
			$pdo = new PDO($DSN_dbname,$username,$password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$wat = $pdo->prepare("SELECT Email FROM users WHERE Username = :username AND mailNotif = :num");
		$wat->execute(array(':username' => $name, ':num'=> 1));
		$found = $wat->rowCount();
		$row = $wat->fetch(PDO::FETCH_ASSOC);
		$mail = $row['Email'];

		if ($found == 1)
		{
			func_mail($Username,$mail);
		}
	} catch(PDOexception $e)
		{
            echo  $e->getMessage();
		}

	}
	function func_mail($username, $mail) {
  
		$to      = $mail; // Send email to our user
		$subject = ' Camagru Signup | Verification'; // Give the email a subject 

		$message = ''.$username.' commented on your picture
		

		'; // Our message above including the link
							
		$headers = 'From:camagruteam@camagru.com' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers); // Send our email


        header("Location: gallery.php");
		$conn = null;
	}

?>
