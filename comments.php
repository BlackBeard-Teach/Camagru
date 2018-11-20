
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

		if (!isset($Username) || empty($Username))
		{?>
            <script type="text/javascript">
                var r = confirm("You must be logged in to comment on pictures...click OK to log in");
                if (r == true) {
                    window.location.href = "login.php";
                } else {
                    alert("You can't comment anonymously!");
                    window.location.href = "gallery.php";
                }
            </script>

		<?php}
		else if (!isset($comment) || empty($comment))
		{?>
            <script type="text/javascript">
                alert("Can't post an empty comment!!")
            </script>
<?php	}
		else if ((isset($Username) && !empty($Username))
			&& (isset($image_id) && !empty($image_id))
			&& (isset($comment) && !empty($comment))) {
            $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $sql = "USE ".$DB_NAME;
            $sql = $dbh->prepare("INSERT INTO comments (Username, comment, image_id)
				VALUES (:Username, :comment, :image_id)");
            $sql->execute(array(':Username' => $Username, ':comment' => $comment, ':image_id' => $image_id));

			}
	}
		catch(PDOException $e)
        {
            echo $sql . "<br>" . $e->getMessage();
        }
        header("Location: gallery.php");
        $conn = null;
?>
