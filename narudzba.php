<?php
    session_start();    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stil.css">
    </head>
    
    <body>
        <div id="menu">
            <?php include 'templates/menu.php';?>
        </div>

        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
        
        <div id="narudzba">
        <?php
            if (!isset($_SESSION['korisnikId'])){
                ?>
                   <p>Morate se prijaviti kako bi mogli naruciti</p> 
                   <a href="prijava.php">Prijava</a>
                <?php
            }else{
                ?>
                 <h2>Adresa za račun i dostavu:</h2>

                <?php
                    include_once 'db_connection.php';
                    $conn = OpenConn();
                    $sql = "SELECT * FROM `kupac` ";
                    $result = $conn->query($sql);
                    if($result && $result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            if($row["kupac_id"]==$_SESSION['korisnikId']){
                                ?>
                                <b><?php echo $row["kupac_ime"];?></b> <b><?php echo $row["kupac_prezime"];?></b>
                                <p><?php echo $row["ulica"];?></p>
                                <p><?php echo $row["grad"];?></p>
                                <p><?php echo $row["postanski"];?></p>
                                <p><?php echo $row["zemlja"];?></p>
                                <p><?php echo $row["telefon"];?></p>
                               <form action="promijeniPodatke.php" method="GET">
                                    <input type="submit" value="Promijeni Podatke">
                               </form>
                                <?php
                                
                            } 
                        }
                    }
                    

                ?>
                <h2>Narudžba:</h2>
                <table border=0>
                <?php
                $ukupno = 0;
                for($i = 0; $i < count($_SESSION['kosarica']); $i++){

                    $kosara = $_SESSION['kosarica'][$i];
                    if($_SESSION['numArt'][$i] == 0) continue;
                    $sql = "SELECT * FROM `artikl`
                            WHERE artikl_id = '$kosara' ";
                    $result = $conn->query($sql);
                    if($result && $result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $cijena = $row['artikl_cijena'];
                            if($row["popust"] != NULL){
                                $cijena = $row["artikl_cijena"] * (1 -($row["popust"] / 100));
                            }
                            $ukupno += $cijena*$_SESSION['numArt'][$i];
                        ?>
                        <tr>
                        <th><?php echo $row['artikl_naziv'];?></th>
                        <th></th>
                        <th><?php echo $cijena  . 'kn' ;?></th>
                        <th></th>
                        <th>
                        Količina:
                       <?php echo $_SESSION['numArt'][$i];?> 
                       
                        
                        
                        </tr>
                        
                        
                        <?php
                        
                    }
                }
                
            }
                ?>
                </table>
                <h3>Ukupno: <?php echo $ukupno. ' kn';?></h3>
                <h2>Dostava:</h2>
                    <form id="dostavaForm" action="placanje.php" method="post">
                    <input type="radio" name="dostavljanje" value="dostava" checked="checked"> Dostava 20 kn </input>
                    <br><input type="radio" name="dostavljanje" value="osobno"> Osobno preuzimanje </input>
                   <br><br> Napomena: <br>
                    <textarea  name="napomena" form="dostavaForm"></textarea>
                  <br> <br> <br><input type="submit" value="Nastavi na odabir placanja">
                    </form>
                    
                <?php
            }
           
        ?>
        </div>

        
    </body>


</html>