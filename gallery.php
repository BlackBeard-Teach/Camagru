<?php
session_start();
require_once 'Config/database.php';

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $dbh->prepare("SELECT images.image_id,images.image, COUNT(likes.like_id) AS likes,
                    GROUP_CONCAT(users.Username SEPARATOR '|') AS liked_by FROM images LEFT JOIN likes
                    ON images.image_id = likes.image_id LEFT JOIN users
                    ON likes.user = users.Username GROUP BY images.image_id
                    ");
$sql->execute();

while ($result = $sql->fetch(PDO::FETCH_ASSOC))
{
    $result['liked_by'] = $result['liked_by'] ? explode('|', $result['liked_by']) : [];
    $img[] = $result;
}
?>
<?php
session_start();

require_once 'Config/database.php';
    try {
        // Create database connection
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Initialize message variable
        $msg = "";
        if (isset($_POST['upload'])) {
            // If upload button is clicked ...
            if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                // Get image name
                $image = $_FILES['image']['name'];
                // Get text
                $image_text = $_POST['image_text'];

                // image file directory
                $target = "images/" . basename($image);
                echo $username = $_SESSION['username'];

                $sql = "INSERT INTO images (image, user, text) 
		  VALUES ('" . $image . "', '" . $username . "', '" . $image_text . "')";
                $sql = $dbh->prepare($sql);
                $sql->execute();
                // execute query

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    $msg = "Image uploaded successfully";
                } else {
                    $msg = "Failed to upload image";
                }
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $dbh->prepare("SELECT * FROM images");
                $sql->execute(array(':images' => $image));
                $result = $sql->fetch();
                header("Location: gallery.php");
            }
            else
            { ?>
                <script type="text/javascript">
                    var r = confirm("You must be logged in to upload pictures...click OK to log in");
                    if (r == true) {
                        window.location.href = "login.php";
                    } else {
                        alert("You can't upload anonymously!");
                        window.location.href = "gallery.php";
                    }
                </script>
         <?php   }
        }

    } catch (PDOException $e) {
        echo "Error failed to find images: " . $e->getMessage();
    }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .comment-box
        {
            background: silver;

        }
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
        }
        body {font-family: Arial, Helvetica, sans-serif;}

        .navbar {
            width: 100%;
            background-color: #555;
            overflow: auto;
        }

        .navbar a {
            float: left;
            padding: 12px;
            color: white;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: #000;
        }

        .active {
            background-color: #4CAF50;
        }

        @media screen and (max-width: 500px) {
            .navbar a {
                float: none;
                display: block;
            }
        }

    </style>
</head>
<body>
<header style="display: flex;">
    <div class="logo-signup">
        <img src="teach.jpg">
    </div>
    <div class="navbar">
    <a class="active" href="home.php"><i class="fa fa-fw fa-home"></i> Home</a>
    <a href="#"><i class="fa fa-fw fa-search"></i> Search</a>
    <a href="cam.php"><i class="fa fa-fw fa-picture-o"></i>Camera</a>
    <a href="login.php"><i class="fa fa-fw fa-user"></i> Log Out</a>
    </div>
</header>
<div id="content">

    <?php foreach ($img as $pic):?>
        <div class="pic">
            <div id='img_div'>
                <img src='images/<?=$pic['image'];?>' >
                <p><?=$pic['text'];?></p>
            </div>
            <button><a class="fa fa-thumbs-up" aria-hidden="true" href="like.php?type=image&image_id=<?php echo $pic['image_id']; ?>"></a></button>
            <p><b><?php echo $pic['likes']; ?> people like this</b></p>
            <form action="comments.php" id="commentform" method="POST">
                <input type= "hidden" value="<?php echo $pic['image_id']; ?>" name="image_id">
                <textarea name="comment_txt" placeholder="Comment on picture"></textarea>
                <input type="submit">
            </form>
            <div class="comment-box">
            <?php
            $id = $pic['image_id'];
            $sql = $dbh->prepare("SELECT * FROM comments WHERE image_id=:image_id");
            $sql->execute(array(':image_id' => $id));
            $comments = $sql->fetchAll();
            echo '<table><ul class="list_item">';
            for ($j=0; $j < sizeof($comments); $j++)
            {
                $comment = $comments[$j]['comment'];
                $comment_by = $comments[$j]['Username'];
                echo'
						<tr>
						<td><li class="list_item">'
                    . $comment_by .
                    ' - </li><td>'
                    . $comment .
                    '</td>' .
                    '</td>
						</tr>
						';
            }
            echo '
					</ul></table>
					';
            ?>
            </div>
        </div>
    <?php endforeach; ?>

    <form method="POST" action="gallery.php" enctype="multipart/form-data" >
        <input type="hidden" name="size" value="1000000">
        <div>
            <input type="file" name="image">
        </div>
        <div>
      <textarea id="text" cols="40" rows="4" name="image_text" placeholder="Comment on the image">
      </textarea>
        </div>
        <div>
            <button type="submit" name="upload">Upload</button>
        </div>
    </form>

</body>
</html>