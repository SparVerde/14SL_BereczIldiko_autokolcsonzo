<h1>Eladó Autók</h1>

<?php
//a megjelenítéshez az adatbázist kell elérnünk, ezt a köv. sql utasítással kapjuk meg
$sql = "SELECT `marka`,`tipus`,`uzemanyag`, `gyartasi_ev`, `eladasi_ar`, `kep` , `leiras` FROM `autok`";
//conn objektum query metódusát futtatjuk és true vagy false értékkel jön vissza
if($result = $conn->query($sql)){
    //-- sikeres lekérdezés feldolgozása
    //ha nem nulla sora van:
    if($result->num_rows > 0){
        //oszlop nevével hivatkozunk a fetch_assoc metódusnál
        while ($row = $result->fetch_assoc()){
            //float egymás mellett jelennek meg és margin-t is adunk hozzá....
            echo '<div class="card" style="width:400px" float:left; margin: 1rem">';
            if($row["kep"] != null){
                //var_dump($row["kep"]);
                //echo $row["kep"];
                //kép forrása az uploads mappában van, az adatbázis kép tulajdonsága ["kép"]:
                echo '<img src="'.$row["kep"].'" class="card-img-center" alt="'.$row["kep"].'">';
                //echo '<img src="'."uploads//".$row["kep"].'" class="card-img-center" alt="'.$row["kep"].'">';
                //$target_dir."/".$_FILES["file"]["name"].date("Ymdhis").".".$imageType
                
            }
            //card body-ba tesszük bele a leírást:,
            
            echo '<div class="card-body">
                    <h5 class="card-title" style ="margin: 5px">'.$row["marka"]." ".$row["tipus"].'</h5>
                    <p class="card-text" style ="font-size: 12px">'."üzemanyag: ".$row["uzemanyag"]."<br>"."gyártási év: ".$row["gyartasi_ev"]."<br>"."eladási ár: ".$row["eladasi_ar"].'</p>
                    
                    
              </div>
              <div class="card-footer" style ="font-size: 10px"><p>'."leírás: ".$row["leiras"].'</p></div>
            </div>';
        }
    }
} else {
    echo 'Sikertelen lekérdezés';
}