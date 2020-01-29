<?php
    session_start();  
    $dostava=$napomena=$korisnikId=$placanje=$karticaId = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $dostava = $_SESSION['dostava'];
        $napomena = $_SESSION['napomena'];
        $korisnikId = $_SESSION['korisnikId'];
        $placanje = "gotovina";
        $ukupno = $_SESSION['ukupno'];
        if($dostava  == "dostava"){
            $ukupno += 20;
        }
        $datum = date("Y-m-d");
        $err = false;

        include_once 'db_connection.php';
        $conn = OpenConn();
        $sql = "SET FOREIGN_KEY_CHECKS=0";
        
        $conn->query($sql); 
        $sql = "INSERT INTO `narudzba` ( `kupac_id`, `status`, `datum`, `dostava`, `napomena`, `placanje`, `ukupno`)
        VALUES ('$korisnikId', 'naruceno', '$datum', '$dostava', '$napomena', '$placanje', '$ukupno')";
        if($conn->query($sql)){
            $sql = "SELECT `narudzba_id` FROM `narudzba` ORDER BY `narudzba_id` DESC LIMIT 1";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $narudzbaId = $row['narudzba_id'];
            
            for($i = 0; $i < sizeof($_SESSION['kosarica']); $i++){
                if($_SESSION['numArt'][$i] > 0){
                    $kolicina = $_SESSION['numArt'][$i];
                    $artId = $_SESSION['kosarica'][$i];
                   
                    $sql = "INSERT INTO `na_artikl` (`narudzba_id`, `stavka_id`, `artikl_id`, `kolicina`, `popust`)
                    VALUES ('$narudzbaId', '$artId', '$artId', '$kolicina', '0')";
                    if(!$conn->query($sql)){
                        $err = true;
                    }
                    
                } 
            }
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if(!$err){
            $sql = "SET FOREIGN_KEY_CHECKS=1";
            $conn->query($sql); 
            unset($_SESSION['num']);
            unset($_SESSION['numArt']);
            unset($_SESSION['kosarica']);
            unset($_SESSION['dostava']);
            unset($_SESSION['napomena']);
            unset($_SESSION['ukupno']);
            header("Location: http://localhost/dashboard/RWA/zavrsetakNarudzbe.php");
        }
      
        
       
       
       
        
    }  
   
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stil.css">
    </head>
    
    <body>
        <div id="menu">
            <?php include 'templates/menu.php';?>
        </div>


<div class="row">
        
        <div id="placanje">
        <form action="placanjeGotovinom.php" method="POST">
          <h3>Odaberi način plaćanja:</h3>
          <input type="radio" name="placanje" value="gotovina" checked="checked" onclick="window.open('http://localhost/dashboard/RWA/placanjeGotovinom.php', '_self');">Plaćanje gotovinom pri preuzimanju </input>
          <br> <br><input type="radio" name="placanje" value="kartica" onclick="window.open('http://localhost/dashboard/RWA/placanjeKarticom.php', '_self');">Kartično plaćanje </input>
          <br><br>
            
            
            <input type="submit" class="Button2" value="Završi narudžbu">
 
            </form>
        </div>

        <div id="trazilica" >
			<?php include 'templates/trazilicaIPoruka.php';?>
        </div>

</div>

    </body>


</html>