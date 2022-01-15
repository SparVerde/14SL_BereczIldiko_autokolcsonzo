<?php
//belépés változót keressük igaz logikai értékkel, rákattintott-e: INPUT_POST "belepes" változóval true logikai érték-e 
//ha igen lekérdezzük megadva a 2 belépési értéket
//majd login alapján le kell kérdezni a jelszót, majd azt érvényesíteni a password validatre-el:
//azaz az adott felhasználó névhez tartozik-e jelszó és megnézzük, hogy az egyezik -e a megadottal
if(filter_input(INPUT_POST, "belepes", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)){
    $loginname = filter_input(INPUT_POST, "felhasznalo_nev", FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, "password");
    $sql = 'SELECT `password` FROM `felhasznalo` WHERE `felhasznalo_nev`=?';
    //majd megint előkészítjük az utasítást a prepare($sql) metódussal és az elkészített statement utasítás objektumot 
    //és annak bind metódusát hívjuk meg a loginname-re:
    //és futtatjuk execute():
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $loginname);
    $stmt->execute();
    
    //lekérdezzük, hogy ilyen adatokkal van-e felhasználónk
    $result = $stmt->get_result();
    if(password_verify($password, $result->fetch_assoc()["password"])){
        
        //-- felhasználói adatok beolvasása
        $result = $conn->query('SELECT * FROM `felhasznalo` WHERE `felhasznalo_nev`= "'.$loginname.'";');
        $_SESSION['felhasznalo'] = $result->fetch_assoc();
        $_SESSION['login'] = true;
        echo '<div class="alert alert-success">
        <strong>Sikeres bejelentkezés!</strong>
        </div>';
        header("Location: index.php?menu=home");
        
    } else {
        //echo 'Belépés sikertelen!';    
        echo '<div class="alert alert-danger">
        <strong>Sikertelen bejelentkezés!</strong>
        </div>';
    }
}
?>

<h1>Bejelentkezés</h1>
<form method="POST">
      <div class="form-group">
            <label for="felhasznalo_nev">Felhasználó név</label>
            <input type="text" class="form-control" id="felhasznalo_nev" name="felhasznalo_nev">
      </div>
      <div class="form-group">
            <label for="password">Jelszó</label>
            <input type="password" class="form-control" id="password" name="password">
      </div>
    <button type="submit" class="btn btn-primary" name="belepes" value="true">Belépés</button>
</form>