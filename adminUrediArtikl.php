<?php
    include_once 'db_connection.php';
    $conn = OpenConn();
    $save = true;
    $id = $naziv = $cijena = $kategorija = $slika = $opis = $kategorijaErr = $cijenaErr= $urediErr='';
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $id = $_GET["id"];
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];
        if(empty($_POST['naziv']) || empty($_POST['cijena'])
        || empty($_POST['kategorija']) || empty($_POST['slika'])
        || empty($_POST['opis'])){
            $urediErr = 'Sve mora bit ispunjeno';
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
            `slika` = '$slika', `opis` = '$opis'
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

        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
        
        <div id="promjenaPodataka">
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
                            <input type="text" name="id" value="<?php echo $row['artikl_id'];?>" hidden>
                            <input type="text" name="naziv" value="<?php echo $row['artikl_naziv'];?>"> </input>
                            <br> <br>
                            Cijena:
                            <input type="text" name="cijena" value="<?php echo $row['artikl_cijena'];?>"> </input>
                            <?php echo $cijenaErr;?>
                            <br> <br>
                            Kategorija:
                            <input type="text" name="kategorija" value="<?php echo $row['artikl_kategorija'];?>"> </input>
                            <?php echo $kategorijaErr;?>
                            <br> <br>
                            Slika:
                            <input type="text" name="slika" value="<?php echo $row['slika'];?>"> </input>
                            <br> <br>
                            Opis:
                            <input type="text" name="opis" value="<?php echo $row['opis'];?>"> </input>
                            <br> <br>
                            
                           <input type="submit" value="Promijeni Podatke">
                      </form>
                      <p><?php echo $urediErr;?></p>
                      <br>
                      <a href="adminPregled.php">Povratak na pregled artikala</a>
                       <?php
                       
                   
               }
           }  
          
                

           closeCon($conn);
           ?>
        </div>

        
    </body>


</html>