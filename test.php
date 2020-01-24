  
        $sql = "UPDATE `artikl` SET `artikl_naziv` = '$naziv',
        `artikl_cijena` = '$cijena', `artikl_kategorija` = '$kategorija',
        `slika` = '$slika', `opis` = '$opis'
        WHERE `artikl`.`artikl_id` = '$id'";
        $conn->query($sql);


        $naziv = $_POST["naziv"];
        echo $naziv;
        $cijena = $_POST["cijena"];
        $kategorija = $_POST["kategorija"];
        $slika = $_POST["slika"];
        $opis = $_POST["opis"];


        
    if($placanje="gotovina") $karticaId = NULL;
    else $karticaId = rand(0, 100);

    include_once 'db_connection.php';
    $conn = OpenConn();
    $sql = "INSERT INTO `narudzba` (`narudzba_id`, `kupac_id`, `status`, `datum`, `dostava`, `napomena`, `placanje`, `karticaId`)
    VALUES (NULL, '$korisnikId', 'naruceno', '$datum', '$dostava', '$napomena', '$placanje', '$karticaId')";
    $conn->query($sql);
