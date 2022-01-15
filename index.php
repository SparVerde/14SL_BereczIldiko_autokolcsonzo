<?php

header('Content-type: text/html; charset=utf-8');
//adatbázis kapcsolat létrehozása
require_once './connect.php';
session_start();
//menu környezeti változó vagy php változó GET globális változóba kerül és string
$menu = filter_input(INPUT_GET, "menu", FILTER_SANITIZE_STRING);
$login = isset($_SESSION["login"])?$_SESSION["login"]:false;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 30 * 60)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autók</title>
    <style>
            img {
                max-width: 150px;
                height: 150px;
                size: auto;
            }
            .card {
                max-width: 300px;
                float: left;
                text-align: center;
                margin: .2vw;
                padding: .5vw;
                height: 300px;
                border: 1px solid darkgray;
            }
            .info {
                padding: 0px;
                margin: 0px;
            }
            header {
                text-align: left;
                padding: .8vw;
            }
            body {
                margin: 1vw;
            }
            .jobb{
                float: right;
            }
        </style>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
        <header>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link <?php echo $menu=="home"?"active":""; ?>" href="index.php?menu=home">Főoldal</a>
                </li>
<?php
//phpinfo();
if(!$login){
            ?>
                <li class="nav-item jobb" style="float:right">
                    <!--href get-tel kapja meg, mindíg az aktuális lap az active ezt php kódként adhatjuk meg -->
                    <a class="nav-link <?php echo $menu=="bejelentkezes"?"active":""; ?>" style="float:right" href="index.php?menu=bejelentkezes">Bejelentkezés</a>
                </li>
                <li class="nav-item" style="float:right">
                    <a class="nav-link <?php echo $menu=="regisztracio"?"active":""; ?>" href="index.php?menu=regisztracio">Regisztráció</a>
                </li>
                </ul>
                <?php
        } else {
        ?>
                <li class="nav-item" style="float:right">
                    <!--disabeled -el is lehetne,de az nem szép megoldás
                környezti változóval is lehet php változóval ami menu, ezzel irányítjuk, hogy a tartalomból mi töltődjön be a menü értékétől függően-->
                    <a class="nav-link <?php echo $menu=="kilepes"?"active":""; ?>" href="index.php?menu=kilepes">Kilépés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $menu=="feltoltes"?"active":""; ?>" href="index.php?menu=feltoltes">Autó feltöltése</a>
                </li>
                <?php
        }
        ?>
         
                
              </ul>
        </header>
        <?php
            
        
        require_once './kontroller.php';
        ?>
        </div>
    
</body>
</html>