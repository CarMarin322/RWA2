<?php
    session_start();  
    include_once 'db_connection.php';
    $conn = OpenConn();
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $ime = $_POST["ime"];
        $prezime = $_POST["prezime"];
        $email = $_POST["email"];
        $rod = $_POST["rod"];
        $ulica = $_POST["ulica"];
        $postanski = $_POST["postanski"];
        $grad = $_POST["grad"];
        $zemlja = $_POST["zemlja"];
        $telefon = $_POST["telefon"];
        $id = $_SESSION["korisnikId"];
        $sql = "UPDATE `kupac` SET `kupac_ime` = '$ime',
        `kupac_prezime` = '$prezime', `kupac_mail` = '$email',
        `rod` = '$rod', `ulica` = '$ulica',
        `postanski` = '$postanski', `grad` = '$grad',
        `zemlja` = '$zemlja', `telefon` = '$telefon'
        WHERE `kupac`.`kupac_id` = '$id'";
        $conn->query($sql);
      
        
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

        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
        
        <div id="promjenaPodataka">
           <?php
           
          
           $sql = "SELECT * FROM `kupac` ";
           $result = $conn->query($sql);
           if($result && $result->num_rows > 0){
               while($row = $result->fetch_assoc()){
                   if($row["kupac_id"]==$_SESSION['korisnikId']){
                       ?>
                      <form action="promijeniPodatke.php" method="POST">
                          <h2>Izmjena podataka</h2>
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
                           <input type="submit" value="Promijeni Podatke">
                      </form>
                      <a href="narudzba.php">Povratak na narudzbu</a>
                       <?php
                       
                   } 
               }
           }  
          
                

           closeCon($conn);
           ?>
        </div>

        
    </body>


</html>