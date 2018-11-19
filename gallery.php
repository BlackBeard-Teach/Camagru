<?php
require_once 'Config/database.php';

$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = $dbh->prepare("
                    SELECT
                    images.image_id,
                    images.image,
                    COUNT(likes.like_id) AS likes,
                    GROUP_CONCAT(users.Username SEPARATOR '|') AS liked_by
                    
                    FROM images

                    LEFT JOIN likes
                    ON images.image_id = likes.image_id

                    LEFT JOIN users
                    ON likes.user = users.Username

                    GROUP BY images.image_id
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

        // If upload button is clicked ...
        if (isset($_POST['upload'])) {
            // Get image name
            $image = $_FILES['image']['name'];
            // Get text
            $image_text = $_POST['image_text'];

            // image file directory
            $target = "images/" . basename($image);
            echo $username = $_SESSION['Username'];

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
        }
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = $dbh->prepare("SELECT * FROM images");
        //$sql->bindParam(':images', $images);
        $sql->execute(array(':images' => $images));
        $result = $sql->fetch();
    } catch (PDOException $e) {
        echo "connection failed: " . $e->getMessage();
    }

?>


<!DOCTYPE html>
<html>
<head>
    <title>Image Upload</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<header style="display: flex;">
    <div class="logo-signup">
        <img src="pictures/logo.png">
    </div>
    <ul class="signup-nav">
        <li><a href="home.php">HOME</a></li>
        <li><a href="cam.php">CAMERA</a></li>
        <li><a href="logout.php">LOGOUT</a></li>
    </ul>
</header>
<div id="content">

    <?php foreach ($img as $pic):?>
        <div class="pic">
            <div id='img_div'>
                <img src='images/<?=$pic['image'];?>' >
                <p><?=$pic['text'];?></p>
            </div>
            <a href="like.php?type=image&image_id=<?php echo $pic['image_id']; ?>">LIKE</a>
            <p><?php echo $pic['likes']; ?> people like this.</p>

            <?php if(!empty($pic['liked_by'])): ?>
                <ul>
                    <?php foreach($pic['liked_by'] as $_SESSION['Username']): ?>
                        <li><?php echo $_SESSION['Username'] ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <form action="Img_comments.php" id="commentform" method="GET">
                <input type= "hidden" value="<?php echo $pic['image_id']; ?>" name="image_id">
                <textarea type="text" name="comment_txt"></textarea>
                <input type="submit">
            </form>
            <?php
            $id = $pic['image_id'];
            $sql = $dbh->prepare("SELECT * FROM comments WHERE image_id=:image_id");
            $sql->execute(array(':image_id' => $id));
            $comments = $sql->fetchAll();
            echo '<table><ul>';
            for ($j=0; $j < sizeof($comments); $j++)
            {
                $comment = $comments[$j]['comment'];
                $comment_by = $comments[$j]['Username'];
                echo'
						<tr>
							<td><li>'
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
            <button type="submit" name="upload">comment</button>
        </div>
    </form>

</body>
</html>
