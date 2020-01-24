<?php
    session_start();  
    include_once 'db_connection.php';
    $conn = OpenConn();
    $save = true;           
        $ime_err = $ulica_err= $prezime_err= $email_err = '';
        $telefon_err = $grad_err = $zemlja_err = $pobr_err =  '';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["ime"])){
        
            $ime_err = "Molimo vas unesite vaše ime";
           $save = false;
        }else{
            $ime = test_input($_POST["ime"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$ime)) {
                $ime_err = "Samo slova i razmak su dopušteni";
                $save = false;
            }
        }

        if(empty($_POST["prezime"])){
            $prezime_err = "Molimo vas unesite vaše prezime";
            $save = false;
        }else{
            $prezime = test_input($_POST["prezime"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$prezime)) {
                $prezime_err = "Samo slova i razmak su dopušteni";
                $save = false;
            }
        }

       

        if(empty($_POST["email"])){
            $email_err = "Molimo vas unesite vaš email";
            $save = false;
        }else{
            $email = test_input($_POST["email"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_err = "Nevažeći email";
                $save = false;
            }
           
        }

      
        
        $telefon = test_input($_POST["telefon"]);
        if(is_numeric($telefon) == false && $telefon != ""){
            $telefon_err = "Ne možete imati slova unutar broja telefona";
            $save = false;
        } 

                
        
        if(empty($_POST["ulica"])){
            $ulica_err = "Molimo vas unesite vašu ulicu";
            $save = false;
        }else{
            $ulica = test_input($_POST["ulica"]);
            
        }

        
        if(empty($_POST["pobr"])){
            $pobr_err = "Molimo vas unesite vaš poštanski broj";
            $save = false;
        }else{
            $pobr = test_input($_POST["pobr"]);
            if(is_numeric($pobr) == false && $pobr != ""){
                $pobr_err = "Ne možete imati slova unutar poštanskog broja";
                $save = false;
            } 
        }
        if(empty($_POST["grad"])){
            $grad_err = "Molimo vas unesite vaš grad";
            $save = false;
        }else{
            $grad = test_input($_POST["grad"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$grad)) {
                $grad_err = "Samo slova i razmak su dopušteni";
                $save = false;
            }
        }
        if(empty($_POST["zemlja"])){
            $zemlja_err = "Molimo vas unesite zemlja";
            $save = false;
        }else{
            $zemlja = test_input($_POST["zemlja"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$zemlja)) {
            $zemlja_err = "Samo slova i razmak su dopušteni";
            $save = false;
            }
        }
       
        
        
        $id = $_SESSION["korisnikId"];
        
        if($save){
        $sql = "UPDATE `kupac` SET `kupac_ime` = '$ime',
        `kupac_prezime` = '$prezime', `kupac_mail` = '$email',
        `ulica` = '$ulica',
        `postanski` = '$pobr', `grad` = '$grad',
        `zemlja` = '$zemlja', `telefon` = '$telefon'
        WHERE `kupac`.`kupac_id` = '$id'";
        $_SESSION['korisnik'] = $ime;
        $conn->query($sql);
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
                            <?php echo $ime_err;?>
                            <br> <br>
                            Prezime:
                            <input type="text" name="prezime" value="<?php echo $row['kupac_prezime'];?>"> </input>
                            <?php echo $prezime_err;?>
                            <br> <br>
                            
                            Email:
                            <input type="text" name="email" value="<?php echo $row['kupac_mail'];?>"> </input>
                            <?php echo $email_err;?>
                            <br> <br>
                            Ulica:
                            <input type="text" name="ulica" value="<?php echo $row['ulica'];?>"> </input>
                            <?php echo $ulica_err;?>
                            <br> <br>
                            Poštanski broj:
                            <input type="text" name="pobr" value="<?php echo $row['postanski'];?>"> </input>
                            <?php echo $pobr_err;?>
                            <br> <br>
                            Grad:
                            <input type="text" name="grad" value="<?php echo $row['grad'];?>"> </input>
                            <?php echo $grad_err;?>
                            <br> <br>
                            Zemlja:
                            <input type="text" name="zemlja" value="<?php echo $row['zemlja'];?>"> </input>
                            <?php echo $zemlja_err;?>
                            <br> <br>
                            Telefon:
                            <input type="text" name="telefon" value="<?php echo $row['telefon'];?>"> </input>
                            <?php echo $telefon_err;?>
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