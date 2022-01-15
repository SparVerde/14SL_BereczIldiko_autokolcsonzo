<?php


require_once './connect.php';
$err=false;
//a feldolgozás módja POST
//megnézzük, hogy rákattintott-e filter_input methódussal, POST környezeti változóban regisztralt boolen értéke
if(filter_input(INPUT_POST, "regisztral", FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)){
      //if true vannak feldolgozandó értékek
      //értékek feldolgozása: az értékek lekérdezése a POST körny. változó adott (loginame, ...) értékével 
      //azok ellenőrzése server oldalon (string kényszerítéssel)
      //majd az sql INSERT utasítás
      $felhasznalo_nev = filter_input(INPUT_POST, "felhasznalo_nev", FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
      //var_dump($felhasznalo_nev); //ellenőrzés!
      $sql_user = "SELECT `felhasznalo_nev` FROM `felhasznalo` WHERE `felhasznalo_nev` = '$felhasznalo_nev' LIMIT 1";
      //var_dump($sql_user);
      $result = $conn->query($sql_user);
      //var_dump($result);
      if($result->num_rows > 0){
      $err = true;    
      echo 'A felhasználónév foglalt!';}
      //else{echo 'A felhasználónév nem foglalt!';}
      
      $email = filter_input(INPUT_POST, "email");
      //var_dump($email);
      $password = password_hash(filter_input(INPUT_POST, "password"), PASSWORD_BCRYPT);
      //var_dump($password);
     
      $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
      //var_dump($phone);
      
      $sql = "INSERT INTO `felhasznalo`(`felhasznalo_nev`, `email`, `password`, `phone`) VALUES (?,?,?,?)";
      //előkészítjük prepare() és ezzel egy utasítás objektum jön létre stmt (statement) 
      //ennek adjuk át a felhasználó értéket a bind_param metódussal az értékek számának (s db szám) és típusának megadásával
      //password a password hash-el közlekedik (lásd fent): 
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssss", $felhasznalo_nev, $email, $password, $phone);
      //majd a statement-et lefuttatjuk execute() metódussal, ami logikia értéket ad vissza, ha true Sikeres regisztráció...
  
      if($stmt->execute()){
            echo '<div class="alert alert-succes">
            <strong>Sikeres regisztráció!!!</strong>
            </div>';
            
           // header("Location: index.php?menu=home");
        } else {
            echo '<div class="alert alert-danger">
            <strong>Rögzítés sikertelen!</strong>
            </div>';
            
        }
        //var_dump($stmt->execute()); //ellenőrzés mindíg false-t ír ki
      //ha nem regisztrál ez lesz az else ágban. 
  } else {
  
  
  ?>
  
  <h1>REGISZTRÁCIÓ</h1>
  <!--a name érték megadása a php miatt kell (ott a name értéket használjuk az inputból), és bootstrap osztályt használtunk class=-->
  <form method="POST" >
        <div class="form-group">
              <label for="felhasznalo_nev">Felhasználó név</label>
              <input type="text" class="form-control" id="felhasznalo_nev" name="felhasznalo_nev" required
              value="<?php echo isset($felhasznalo_nev)?$felhasznalo_nev:""; ?>">
        </div>
        
        <div class="form-group">
              <label for="email">Email cím</label>
              <input type="email" class="form-control" id="email" name="email" 
              required pattern ="^[0-9a-z\.-]+@([0-9a-z-]+\.)+[a-z]{2,4}$"
              value="<?php echo isset($email)?$email:""; ?>">
        </div>
        <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        </div>
    
        <div class="form-group">
              <label for="phone">Telefon</label>
              <input type="phone" class="form-control" id="phone" name="phone" required
              value="<?php echo isset($phone)?$phone:""; ?>">
        </div>
       
       
        
        
       
  <!--a button-nak valut kell adnunk-->
      <button type="submit" class="btn btn-primary" name="regisztral" value="true">Regisztráció</button>
  </form>
  <?php
  //megjelenítés, hogy kapott-e adatot:
  var_dump($_POST); //ellenőrzés
  
  }
