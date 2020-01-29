<?php
    session_start();   
    include_once 'db_connection.php';
    $conn = OpenConn();
    $save = true;
    $naziv = $cijena = $kategorija = $slika = $opis = '';
    $kategorijaErr = $cijenaErr = $dodajErr= '';
    $popust = NULL;
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!empty($_POST['popust'])){
            $popust = $_POST['popust'];
        }
        if(empty($_POST['naziv']) || empty($_POST['cijena'])
        || empty($_POST['kategorija']) || empty($_POST['slika'])
        || empty($_POST['opis'])){
            echo 'Sve mora bit ispunjeno';
        }else{
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
                $sql = "INSERT INTO `artikl` (`artikl_id`, `artikl_naziv`, `artikl_cijena`, `artikl_kategorija`, `slika`, `opis`, `popust`)
                VALUES ('', '$naziv', '$cijena', '$kategorija', '$slika', '$opis', '$popust')";
                if ($conn->query($sql) === TRUE) {
                    $dodajErr = "Artikl je dodan u bazu";
                } else {
                    $dodajErr = "Neuspješno dodavanje Artikla";
                }
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
    CloseCon($conn); 
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

        

        <div id="dodajArtikl">
        <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik'] == "admin"){ ?>
            <h3>Dodavanje Artikala:</h3>
            <br>
            <form action="adminDodajArtikl.php" method ="POST">
            Naziv:
            <input type="text" class="ftekst" name="naziv">
            <br> <br>
            Cijena:
            <input type="text" class="ftekst" name="cijena">
            <?php echo $cijenaErr;?>
            <br> <br>
            Popust:
            <input type="text" class="ftekst" name="popust">
            <br> <br>
            Kategorija:
            <input type="text" class="ftekst" name="kategorija">
            <?php echo $kategorijaErr;?>
            <br> <br>
            Slika:
            <input type="text" class="ftekst" name="slika">
            <br> <br>
            Opis:
            <br>
            <textarea name="opis" cols="60" rows="30"></textarea>
            <br> <br>
            <input type="submit" class="Button2" value="Dodaj">
            </form>
            <br>
            <button class="Button2"><a href="adminPregled.php">Povratak na pregled artikala</a></button>
            <br>
            <p> <?php echo $dodajErr;?></p>
        
        
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