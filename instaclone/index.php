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
    <div id="topbody">
        <div id="top1">
            <p id="naamEnKlas">Luc Drenth - MD1A</p>
        </div>
        <div id="top2">
            <h1>Instaclone</h1>
        </div>
        <ul class="navigationBar">
            <li id="active" class="navigations"><a href="index.php">HOME<br> <i class="material-icons">&#xE5C7;</i></a>
            </li>
            <li class="navigations"><a href="login.html">LOGIN</a></li>
            <li class="navigations"><a href="registreer.html">REGISTREER</a></li>
            <li class="navigations"><a href="upload.php">UPLOAD</a></li>
        </ul>
    </div>

    <div id="midbody">
        <div id="left">
            <h3>Linker gedeelte</h3>
        </div>

        <div id="middle">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <select name="sorteermenu" id="select_sorteer">
                    <option value="date_asc">datum oplopend</option>
                    <option value="date_desc">datum aflopend</option>
                    <option value="random">random</option>
                    <option value="descr_asc">beschrijving oplopend</option>
                    <option value="descr_desc">beschrijving aflopend</option>
                </select>
                <input type="submit" name="submit_sort" value="sorteren" id="submit_soorteer"/>
            </form>

            <form method="post" action="<?php echo$_SERVER['PHP_SELF']; ?>">
                <input type="text" name="searchterm" placeholder="zoekterm" id="text_zoek"/>
                <input type="submit" name="submit_search" value="zoeken" id="submit_zoek"/>
            </form>

            <h3>Geuploade fotos</h3>
            <?php

            $columna = 'date';
            $order = 'ASC';

            if(isset($_POST['submit_sort'])){
                switch($_POST['sorteermenu']){
                    case 'date_asc':
                        $columna = 'date';
                        $order = 'ASC';
                        break;
                    case 'date_desc':
                        $columna = 'date';
                        $order = 'DESC';
                        break;
                    case 'random':
                        $columna = 'rand()';
                        $order = '';
                        break;
                }
            }

            define('HOST', 'localhost');
            define('USER', '23924_mamp');
            define('PASS', '23924_wachtwoord');
            define('DBNAME', 'CRUD');


            $dbc = mysqli_connect(HOST, USER, PASS, DBNAME) or die ('Error 2!');
            if (isset($_POST['submit_search'])){
                $searchterm = mysqli_real_escape_string($dbc,trim($_POST['searchterm']));
                $searchterm = '%' . $searchterm . '%';
            } else{
                $searchterm = '%';
            }
            $query = "SELECT * FROM instaclone 
            WHERE description LIKE '$searchterm'
            ORDER BY $columna $order";
            $result = mysqli_query($dbc, $query);



            while ($row = mysqli_fetch_array($result)) {
                $target = $row['target'];
                $date = $row['date'];
                $username = $row['username'];
                $description = $row['description'];
                echo '<img src="' . $target . '" width=250px . style="border-top: 4px solid #9d7933; margin: 0.5em; padding: 0.3em;"/><br>';
                echo $date . ' from ' . $username . ' ' . '<br>' . $description . '<br>';
            }
            ?>

        </div>

        <div id="right">
            <h3>Login</h3>

            <form>
                <label for="emailadres">emailadres</label>
                <input type="text" name="emailadres" id="emailadres">
                <label for="wachtwoord">wachtwoord</label>
                <input type="password" name="wachtwoord" id="wachtwoord">
            </form>
            <form>
                <input type="submit" name="loginGo" value="Login!" id="loginButton">
            </form>
            <p id="registreerjenu"><a href="registreer.html"><i>Of registeer je nu!</i></a></p>
        </div>
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

