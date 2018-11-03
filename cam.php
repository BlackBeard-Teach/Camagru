<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
<head>
    <meta charset="UTF-8">
    <title>Take pic</title>
    <link rel="stylesheet" href="cam.css">
</head>
<body>
    <div class="cup">
        <div class="camField">
            <video id="video" width="400" height="300"></video>
        </div>
        <div class="picField">
            <canvas id="canvas" width="400" height="300"></canvas>
            <img id="photo" src="">
        </div>
        <input name="call cam" type="submit" value=" Take Pic " id="capture" class="camBtn">
</div>

    <script src="cam.js"></script>
</body>
</HTML>