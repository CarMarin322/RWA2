<?php
    session_start(); 
    $dostava=$napomena=$korisnikId=$placanje=$karticaId = $brojKartice= $mjesecIstek = $godinaIstek = $cvv = '';
    $error = $brojErr = $cvvErr= '';
    $save = true;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST['brojKartice']) || empty($_POST['brojKartice'])){
            $error = "Morate ispuniti sve podatke o kartici";
        }else{
            $dostava = $_SESSION['dostava'];
            $napomena = $_SESSION['napomena'];
            $korisnikId = $_SESSION['korisnikId'];
            $placanje = $_POST['placanje'];
            $datum = date("Y-m-d");
            $ukupno = $_SESSION['ukupno'];
            $err = false;
            $brojKartice = test_input($_POST["brojKartice"]);
            if(is_numeric($brojKartice) == false && $brojKartice != ""){
                $brojErr = "Ne možete imati slova unutar broja kartice";
                $save = false;
            } 
            $cvv = test_input($_POST["cvv"]);
            if(is_numeric($cvv) == false && $cvv != ""){
                $cvvErr = "Ne možete imati slova unutar CVV-a";
                $save = false;
            } else if(strlen($cvv) != 4){
                $cvvErr = "CVV mora sadržavati 4 broja";
                $save = false;
            }

            include_once 'db_connection.php';
            $conn = OpenConn();
            if($save){
                $sql = "SET FOREIGN_KEY_CHECKS=0";
                
                $conn->query($sql); 
                $sql = "INSERT INTO `narudzba` ( `kupac_id`, `status`, `datum`, `dostava`, `napomena`, `placanje`, `ukupno`)
                VALUES ('$korisnikId', 'naruceno', '$datum', '$dostava', '$napomena', '$placanje', '$ukupno')";
                if($conn->query($sql)){
                    $sql = "INSERT INTO `kartica` (`broj`, `istek`, `cvv`, `kupacId`)
                    VALUES ('$brojKartice', '$godinaIstek-$mjesecIstek', '$cvv', '$korisnikId')";
                    
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
                    unset($_SESSION['ukupno']);
                    unset($_SESSION['napomena']);
                   header("Location: http://localhost/dashboard/RWA/zavrsetakNarudzbe.php");
                }else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
       
       
       
        
    } 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
          <form action="placanjeKarticom.php" method = "POST">
          <h3>Odaberi način plaćanja:</h3>
          <input type="radio" name="placanje" value="gotovina" onclick="window.open('http://localhost/dashboard/RWA/placanjeGotovinom.php', '_self');">Plaćanje gotovinom pri preuzimanju </input>
          <br> <br><input type="radio" name="placanje" value="kartica" checked="checked" onclick="window.open('http://localhost/dashboard/RWA/placanjeKarticom.php', '_self');">Kartično plaćanje </input>
          <br><br>
            
            
                
<h3>Podaci o kartici:</h3> <br> 
*Broj kreditne/debitne kartice: 
<input type="text" class="ftekst" name="brojKartice" placeholder="Upišite broj kartice"> </input> <?php echo $brojErr;?>
<br> <br>
*Datum isteka kartice:
<select name="mjesecIstek">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
</select>
<select name="godinaIstek">
    <option value="2020">2020</option>
    <option value="2019">2021</option>
    <option value="2018">2022</option>
    <option value="2017">2023</option>
    <option value="2016">2024</option>
    <option value="2015">2025</option>
    <option value="2014">2026</option>
    <option value="2013">2027</option>
    <option value="2012">2028</option>
    <option value="2011">2029</option>
    <option value="2010">2030</option>
    <option value="2009">2031</option>
    <option value="2008">2032</option>
    <option value="2007">2033</option>
    <option value="2006">2034</option>
    <option value="2005">2035</option>
    <option value="2004">2036</option>
    <option value="2003">2037</option>
    <option value="2002">2038</option>
    <option value="2001">2039</option>
    <option value="2000">2040</option>
 

</select>
<br> <br>
*CVV kod:
<input type="text" class="ftekst" name="cvv" placeholder="xxxx"></input> <?php echo $cvvErr;?>
<br>
<?php echo $error;?>
<h3>Podaci o vlasniku kartice: </h3> 
<p>*Možete platiti isključivo karticom koja glasi na vaše ime*</p> <br>
<?php
 include_once 'db_connection.php';
 $conn = OpenConn();
$sql = "SELECT * FROM `kupac` ";
$result = $conn->query($sql);
if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($row["kupac_id"]==$_SESSION['korisnikId']){
            ?>
            <b><?php echo $row["kupac_ime"];?></b> 
            <b><?php echo $row["kupac_prezime"];?></b>
            <p><?php echo $row["kupac_mail"];?></p>
            <p><?php echo $row["ulica"];?></p>
            <p><?php echo $row["grad"];?></p>
            <p><?php echo $row["postanski"];?></p>
            <p><?php echo $row["zemlja"];?></p>
            <p><?php echo $row["telefon"];?></p>
            
            
                
           
          
            <?php
            
        } 
    }
}  

     

closeCon($conn);
?>

<input type="submit" class="Button3" value = "Plati i završi narudžbu"></input>
            </p>
          </form>
        </div>
        <div id="trazilica" >
			<?php include 'templates/trazilicaIPoruka.php';?>
        </div>
</div>
    </body>


</html>