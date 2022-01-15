
<?php
require_once './connect.php';
        if(filter_input(INPUT_POST,"feltoltes", FILTER_VALIDATE_BOOLEAN)){
            //echo("feltoltes is valid");
           $marka = filter_input(INPUT_POST,"marka", FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
           var_dump($marka);
           $tipus = filter_input(INPUT_POST,"tipus", FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
           $uzemanyag = filter_input(INPUT_POST,"uzemanyag", FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
           $gyartasi_ev = filter_input(INPUT_POST,"gyartasi_ev", FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
            $eladasi_ar = filter_input(INPUT_POST,"eladasi_ar", FILTER_SANITIZE_STRING, FILTER_NULL_ON_FAILURE);
            
        }
        else{
            //echo("hozzaadas nem valid"); //csak tesztelésre
        }
            
?>

<h1>Autók feltöltése</h1>

<form method ="POST" enctype="multipart/form-data">
<div class="form-group">
<label for ="marka">Adja meg az autó márkáját!</label><br>
<input type="text" class="form-control" id="marka" name="marka" maxlength="150" value="<?php echo isset($marka)?$marka:""; ?>" required></input>
</div>
<div class="form-group">
<label for ="tipus">Adja meg az autó típusát!</label><br>
<input type="text" class="form-control" id="tipus" name="tipus" maxlength="150" value="<?php echo isset($tipus)?tipus:""; ?>" required></input>
</div>
<div class="form-group">
<label for ="uzemanyag">Adja meg az autó üzemanyagát!</label><br>
<input type="text" class="form-control" id="uzemanyag" name="uzemanyag" maxlength="150" value="<?php echo isset($uzemanyag)?$uzemanyag:""; ?>" required></input>
</div>
<div class="form-group">
<label for ="gyartasi_ev">Adja meg az autó gyártási évét!</label><br>
<input type="text" class="form-control" id="gyartasi_ev" name="gyartasi_ev" maxlength="4" value="<?php echo isset($gyartasi_ev)?$gyartasi_ev:""; ?>" required></input>
</div>
<div class="form-group">
<label for ="eladasi_ar">Adja meg az autó eladási árát!</label><br>
<input type="text" class="form-control" id="eladasi_ar" name="eladasi_ar" min = "1" value="<?php echo isset($eladasi_ar)?$eladasi_ar:""; ?>" required></input>
</div>
<div class="form-group">
<label for ="file">Válassza ki a feltöltendő képet!</label><br>
<input type="file" class="form-control" id="file" name="file" accept="image/*" value="<?php echo isset($file)?$file:""; ?>" required></input>
</div>
<div class="form-group">
<label for ="leiras">Adja meg a termék leírását!</label><br>
<input type="text" class="form-control" id="leiras" name="leiras" value="<?php echo isset($leiras)?$leiras:""; ?>"></input>
</div>
<button type="submit" name="submit" value="true">Feltöltés</button>
</form>

<div>

   <div>
        <!--A cél hogy a filok beírása adatbázisba történjen-->
        <?php
        //if (isset($_POST) && !empty($_POST) ){
        if(filter_input(INPUT_POST,"submit",FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)) {
        $target_dir = "uploads/"; //--- megadja azt a könyvtárat, ahová a fájlt elhelyezni kívánja, létező mappa a megfelelő jogosultsággal!
        $target_file = $_FILES["file"]["tmp_name"];
        $imageType = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
        //file neve+ dátum megadása és típus, sajnos nem tökéletes:
        move_uploaded_file($target_file, $target_dir."/".$_FILES["file"]["name"].date("Ymdhis").".".$imageType);
//var_dump($_FILES);
        //adatbázisba írás: létre kell hozni egy mysqli objektumot, először connection mysql objektum (localhost,root, jelszó, adatbázis név)
        $conn = new mysqli("localhost","root","","14sl_berecz_ildiko");
        //ha valami baj van, akkor, errno
        if($conn->errno){
            die("Adatbázis nem elérhető");}
        else{
            $marka = filter_input(INPUT_POST, "marka");
            $tipus = filter_input(INPUT_POST, "tipus");
            $uzemanyag = filter_input(INPUT_POST, "uzemanyag");
            $gyartasi_ev = filter_input(INPUT_POST, "gyartasi_ev");
            $eladasi_ar = filter_input(INPUT_POST, "eladasi_ar");
            //var_dump($ar); //OK
            $kep = $target_dir."/".$_FILES["file"]["name"].date("Ymdhis").".".$imageType; 
            //$kep = filter_input(INPUT_POST, "kep"); //KO null érték
            //var_dump($kep); 
            $leiras = filter_input(INPUT_POST, "leiras");
            //var_dump($leiras); //OK
            $sql = "INSERT INTO `autok` (`marka`, `tipus`, `uzemanyag`, `gyartasi_ev`, `eladasi_ar`, `kep`, `leiras`) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            //var_dump($stmt);
            $stmt->bind_param("sssssss", $marka, $tipus, $uzemanyag, $gyartasi_ev, $eladasi_ar, $kep, $leiras);
            //var_dump($stmt);
            //majd a statement-et lefuttatjuk execute() metódussal, ami logikia értéket ad vissza, ha true Sikeres feltöltés...
            if($stmt->execute()){
                echo '<div class="alert alert-succes">
                <strong>Sikeres Feltöltés!</strong>
                </div>';
                
            } else {
                //echo 'Feltöltés sikertelen!?';
                echo '<div class="alert alert-succes">
          <strong>Feltöltés sikertelen!</strong>
          </div>';
            }

            //header("Location: index.php?menu=home");
        }

     


        //header("Location: index.php?menu=home");
    
        // Check if image file is a actual image or fake image
       
           /* $check = getimagesize($_FILES["file"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                echo '<div class="alert alert-succes">
          <strong>Sikeres hozzáadás!</strong>
          </div>';
                $uploadOK = 1;
                $tmp_name = $_FILES["file"]["tmp_name"]; //-- azonosító az átmeneti tárolóban
                var_dump($tmp_name);
                $name = $_FILES["file"]["name"].date("Ymdhi");
                move_uploaded_file($tmp_name, "$target_dir/$name");
            } else {
                echo "File is not an image.";
                $uploadOK = 0;
            }*/
            
          
        //}
    }

        /*var_dump($_FILES);
        //adatbázisba írás: létre kell hozni egy mysqli objektumot, először connection mysql objektum (localhost,root, jelszó, adatbázis név)
        $conn = new mysqli("localhost","root","","slick abroncs");
        //ha valami baj van, akkor, errno
        if($conn->errno){
            die("Adatbázis nem elérhető");}
        else{

        }*/
        ?>
    </div>
