<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div id="head">
    <h2>Welcome to Camagru <?php echo  '<br>'.$_SESSION['username'] ; ?></h2>
   
    <nav>
        <ul>
        <li><a href="logout.php">Logout</a></li>
        <li> <a href="#"> Edit Profile </a>
                <ul>
                <li> <a href="update_password.php">Password</a></li>
                <li> <a href="editUsername.php">Usernames</a></li>
                <li> <a href="editMail.php">Change Email</a></li>
                <li> <a href="mailNotif.php">Mail Notification</a></li>
                </ul>
            </li>
        <li><a href="home.php"> HOME </a></li>
           
           
        </ul>
    </nav>
       <?php
    session_start();
    require_once('config/database.php');

    $name =$_SESSION['username'];
    $result;

    try{
        $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $conn->query("SELECT * FROM `images` WHERE user = '". $name ."' ORDER BY date_added DESC LIMIT 6 ", PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "ERROR EXECUTING: \n".$e->getMessage();
    }
    ?>
    <?php
    if ($result)
        foreach ($result as $row) {
            ?><ul><li style="list-style-type: none;"><img id="e1" src=<?= $row['image']; ?> width="40%" height="auto">
    //Delete button that sends image id to delete_images.php
                <button>
                    <a aria-hidden="true"
                       href="delete_images.php?type=image&image_id=<?php echo $row['image_id']; ?>">
                        Delete</a>
                </button>
            </li></ul>

            <?php
        }
    else
        echo "failure";
    ?>
</div> 
 
</body>
</html>


    
         
