<?php
// ezzel iránytjuk, hogy a tartalomból mi töltődjön be, ezt külön php file-ba írtuk bele kontroller.php alatt
//megvizsgálva a menü értékét, ha menu = 'home' akkor a lista.php töltődjön be (ez nulla esetben is, azaz mindíg töltődjön be)
if($login){
    switch ($menu) {
        case 'home':
        case null:
            require_once 'autok.php';
            break;
        case 'kilepes':
            require_once 'kilepes.php';
            break;
        case 'hozzaadas':
            require_once 'hozzaadas.php';
            break;
        case 'feltoltes':
            require_once 'feltoltes.php';
            break;
        default:
            require_once '404.php';
            break;
    }
} else {
    switch ($menu) {
        case 'home':
        case null:
            require_once 'autok.php';
            break;
        case 'regisztracio':
            require_once 'regisztracio.php';
            break;
        case 'bejelentkezes':
            require_once 'belepes.php';
            break;
        default:
            break;
    }
}
?>