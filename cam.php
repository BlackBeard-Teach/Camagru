<?php
    require_once('config/database.php');

    $name = "Thami";////$_SESSION['username'];
    $result;

    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM `gallery` WHERE username = '". $name ."' ORDER BY upload_date DESC LIMIT 6 ", PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "ERROR EXECUTING: \n".$e->getMessage();
    }
?>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Camera/Upload</title>
    <link rel="stylesheet" href="cam.css">
</head>
<body>
    <div class="c_upload">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">upload pic</button>
        </form>
    </div>
    <div class="c_camera">
        <div class="camField">
            <video id="video" width="400" height="300"></video>
        </div>
        <div class="picField">
            <canvas id="canvas" width="400" height="300"></canvas>
        </div>
        <div id="pose">
            <img id="e1" src="emojis/clouds.png" width="45%" height="45%">
            <img id="e2" src="emojis/flower.png" width="45%" height="45%">
            <img id="e3" src="emojis/nerd.png" width="45%" height="45%">
            <img id="e4" src="emojis/star.png" width="45%" height="45%">
        </div>
    </div>
    <div class="buts">
        <button id="clear" class="clrBtn">Clear</button>
        <button id="capture" class="capBtn">Capture</button>
        <button id="capture1" class="emoBtn">Emoji</button>
        <select id="emos" class="emoSelect">
            <option value="e1">Clouds</option>
            <option value="e2">Flowers</option>
            <option value="e3">Smiley</option>
            <option value="e4">Star</option>
        </select>
        <form action="upload.php" method="POST">
            <input type="hidden" id="photo" name="image_data">
            <input name="call cam" type="submit" value=" Save pic " id="save" class="camBtn">
        </form>
    </div>
    <div id="gallery">
        <?php
            if ($result)
            foreach ($result as $row) {
                ?><img id="e1" src=<?= $row['img_name']; ?> width="29%" height="auto"><?php
            }
            else
                echo "failure";
        ?>
    </div>
    <script src="cam.js"></script>
</body>
</HTML>
