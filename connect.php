<?php
//adatbázis osztály létrehozása a mysqli-ből és hol található a server, a felhasználó, a password, adatbázis neve

$conn = new mysqli('localhost','root','','14sl_berecz_ildiko');
//megnézzük létre jött-e a kapcsolat
if($conn->errno > 0){
    //script futás leállítása
    die('Az adatbázis nem elérhető!');
} 
//a conn objektumnak van egy set_charset metódusa
$conn->set_charset("utf8"); //-- lekerdezés adatai is utf8 kód