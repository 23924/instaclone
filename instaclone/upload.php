<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Instaclone</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>



<body>
<div id="wrapper">
    <div id="top1">
        <p id="naamEnKlas">Luc Drenth - MD1A</p>
    </div>
    <div id="top2">
        <h1>Instaclone</h1>
    </div>
    <ul class="navigationBar">
        <li class="navigations"><a href="index.php">HOME</a></li>
        <li class="navigations"><a href="login.html">LOGIN</a></li>
        <li class="navigations"><a href="registreer.html">REGISTREER</a></li>
        <li class="navigations"><a href="upload.php">UPLOAD  <i class="material-icons" style="left: 763px;">&#xE5C7;</i></a></li>
    </ul>

    <div id="uploadDiv">
    <form enctype="multipart/form-data" method="post" action="upload.php">
        <input type="hidden" name="MAX_FILE_SIZE" value="327681">
        <input type="file" name="images" id="uploadknop"> <br>
        <label for="description">Omschrijving (max. 140 tekens)</label><br>
        <textarea cols="20" name="description" id="description"></textarea>
        <br>
        <input type="submit" name="submit" id="uploadButton" value="Upload!">
    </form>
    </div>

    <div id="footer">
        <ul id="footerul">
            <li class="footerli"><a href="mailto:23924@ma-web.nl">Contact</a></li>
            <li class="footerli">Admin</li>
        </ul>
    </div>
</div>

</body>
</html>

<?php

    define('HOST','localhost');
    define('USER','23924_mamp');
    define('PASS','23924_wachtwoord');
    define('DBNAME','CRUD');



if(isset($_POST['submit'])) {
        $dbc = mysqli_connect(HOST,USER,PASS,DBNAME) or die ('Error!');
        $description = mysqli_real_escape_string($dbc,trim($_POST['description']));
        $target = 'images/' .time() . $_FILES['images']['name'];
        $temp = $_FILES['images']['tmp_name'];
        if(!empty($description)) {
            if(move_uploaded_file($temp,$target)) {
                echo 'br>Gelukt!';
                echo '<br>Gelukt!<br>';
                $query = "INSERT INTO instaclone VALUES (0,NOW(),'$description','$target','luc')";
                $result = mysqli_query($dbc,$query) or die('Error querying.');
            }
        }
    }


?>