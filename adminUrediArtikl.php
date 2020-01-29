<?php
session_start();
    include_once 'db_connection.php';
    $conn = OpenConn();
    $save = true;
    $id = $naziv = $cijena = $kategorija = $slika = $opis = $kategorijaErr = $cijenaErr= $urediErr='';
    $popust = NULL;
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        
        $id = $_GET["id"];
        
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];
        if(!empty($_POST['popust'])){
            $popust = $_POST['popust'];
        }
        if(empty($_POST['naziv']) || empty($_POST['cijena'])
        || empty($_POST['kategorija']) || empty($_POST['slika'])
        || empty($_POST['opis'])){
            $urediErr = 'Sve mora bit ispunjeno osim popusta';
        }else {
            $naziv = test_input($_POST['naziv']);
            $cijena = test_input($_POST['cijena']);
            if(is_numeric($cijena) == false && $cijena != ""){
                $cijenaErr = "Cijena ne može sadržavati slova";
                $save = false;
            } 
            $kategorija = test_input($_POST['kategorija']);
            if(is_numeric($kategorija) == false && $kategorija != ""){
                $kategorijaErr = "Odaberite redni broj kategorije";
                $save = false;
                
            }  
            $slika = test_input($_POST['slika']);
            $opis = test_input($_POST['opis']);
         
            if($save){
            $sql = "SET FOREIGN_KEY_CHECKS=0";
            $conn->query($sql); 
            $sql = "UPDATE `artikl` SET `artikl_naziv` = '$naziv',
            `artikl_cijena` = '$cijena', `artikl_kategorija` = '$kategorija',
            `slika` = '$slika', `opis` = '$opis', `popust` = $popust
            WHERE `artikl`.`artikl_id` = '$id'";
            $conn->query($sql); 
            $sql = "SET FOREIGN_KEY_CHECKS=1";
            $conn->query($sql); 
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


        
        <div id="promjenaPodataka">
        <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik'] == "admin"){ ?>
           <?php
           
          
           $sql = "SELECT * FROM `artikl` 
                   WHERE `artikl_id` = $id";
           $result = $conn->query($sql);
           if($result && $result->num_rows > 0){
               while($row = $result->fetch_assoc()){
                   
                       ?>
                      <form action="adminUrediArtikl.php" method="POST">
                          <h3>Izmjena podataka za artikl:</h3>
                            Naziv:
                            <input type="text" class="ftekst" name="id" value="<?php echo $row['artikl_id'];?>" hidden>
                            <input type="text"class="ftekst"  name="naziv" value="<?php echo $row['artikl_naziv'];?>"> </input>
                            <br> <br>
                            Cijena:
                            <input type="text" class="ftekst" name="cijena" value="<?php echo $row['artikl_cijena'];?>"> </input>
                            <?php echo $cijenaErr;?>
                            <br> <br>
                            Popust:
                            <input type="text" class="ftekst" name="popust" value="<?php echo $row['popust'];?>"> </input>
                            <br> <br>
                            Kategorija:
                            <input type="text" class="ftekst" name="kategorija" value="<?php echo $row['artikl_kategorija'];?>"> </input>
                            <?php echo $kategorijaErr;?>
                            <br> <br>
                            Slika:
                            <input type="text" class="ftekst" name="slika" value="<?php echo $row['slika'];?>"> </input>
                            <br> <br>
                            <img class="imageuredi" src="<?php echo $row["slika"]; ?>"> 
                            <br> <br>
                            Opis:<br>
                            <textarea name="opis" cols="60" rows="15" value="<?php echo $row['opis'];?>"> </textarea>
                            <br> <br>
                            
                           <input type="submit" class="Button2" value="Promijeni">
                      </form>
                      <p><?php echo $urediErr;?></p>
                      <br>
                      <button class="Button2"><a href="adminPregled.php">Povratak na pregled artikala</a></button>
                       <?php
                       
                   
               }
           }  
          
                

           closeCon($conn);
           ?>

<?php

}else{
    ?>
    <p>Niste ovlašteni pristupiti ovoj stranici</p>
    <?php
}
        ?>
        </div>


        </div>
    </body>


</html>