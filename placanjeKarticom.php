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


        <div id="trazilica" >
			<?php include 'templates/trazilicaIPoruka.php';?>
        </div>
        
        <div id="placanje">
          <form action="završetakNarudžbe.php" method = "POST">
          <h3>Odaberi način plaćanja:</h3>
          <input type="radio" name="placanje" value="gotovina" onclick="window.open('http://localhost/dashboard/RWA/placanjeGotovinom.php', '_self');">Plaćanje gotovinom pri preuzimanju </input>
          <br> <br><input type="radio" name="placanje" value="kartica" checked="checked" onclick="window.open('http://localhost/dashboard/RWA/placanjeKarticom.php', '_self');">Kartično plaćanje </input>
          <br><br>
            
            <p id="placanjeKarticom" hidden>
                
<h3>Podaci o kartici:</h3> <br> 
Broj kreditne/debitne kartice: 
<input type="text" name="brojKartice" placeholder="Upišite broj kartice"> </input>
<br> <br>
Datum isteka kartice:
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
CVV kod:
<input type="text" name="cvv" placeholder="xxxx"></input>
<h3>Podaci o vlasniku kartice:</h3> <br>
<?php
 include_once 'db_connection.php';
 $conn = OpenConn();
$sql = "SELECT * FROM `kupac` ";
$result = $conn->query($sql);
if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        if($row["kupac_id"]==$_SESSION['korisnikId']){
            ?>
           
                 Ime:
                 <input type="text" name="ime" value="<?php echo $row['kupac_ime'];?>"> </input>
                 <br> <br>
                 Prezime:
                 <input type="text" name="prezime" value="<?php echo $row['kupac_prezime'];?>"> </input>
                 <br> <br>
                 Email:
                 <input type="text" name="email" value="<?php echo $row['kupac_mail'];?>"> </input>
                 <br> <br>
                 Rod:
                 <input type="text" name="rod" value="<?php echo $row['rod'];?>"> </input>
                 <br> <br>
                 Ulica:
                 <input type="text" name="ulica" value="<?php echo $row['ulica'];?>"> </input>
                 <br> <br>
                 Poštanski broj:
                 <input type="text" name="postanski" value="<?php echo $row['postanski'];?>"> </input>
                 <br> <br>
                 Grad:
                 <input type="text" name="grad" value="<?php echo $row['grad'];?>"> </input>
                 <br> <br>
                 Zemlja:
                 <input type="text" name="zemlja" value="<?php echo $row['zemlja'];?>"> </input>
                 <br> <br>
                 Telefon:
                 <input type="text" name="telefon" value="<?php echo $row['telefon'];?>"> </input>
                 <br> <br>
                
           
          
            <?php
            
        } 
    }
}  

     

closeCon($conn);
?>
<input type="submit" value = "Plati i završi narudžbu"></input>
            </p>
          </form>
        </div>

     
    </body>


</html>