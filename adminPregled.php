<?php
    session_start();    
    include_once 'db_connection.php';
    $conn = OpenConn();
    
    $id;
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = $_POST["id"];
        $sql = "DELETE FROM `artikl` WHERE `artikl`.`artikl_id` = $id";
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

        
        <div id="AdminPregled">
        <h3>Pregled artikala: </h3> <br>
        <form action="adminDodajArtikl.php" method="GET">
            <input type="submit" value="Dodaj artikal">
        </form>
            <table border= 1>
                <tr>
                    <th>Naziv:</th>
                    <th>Cijena:</th>
                    <th>Kategorija:</th>
                    <th>Slika:</th>
                    <th>Opis:</th>
                    <th>Uredi:</th>
                    <th>Izbrisi:</th>
                </tr>
        <?php
                    
            
            $sql = "SELECT * FROM `artikl`";
            $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        ?>
                        
                              
                                <tr>
                                    <td><?php echo $row["artikl_naziv"]; ?></td>
                                    <td><?php echo $row["artikl_cijena"]; ?></td>
                                    <td><?php echo $row["artikl_kategorija"]; ?></td>
                                    <td><img src="<?php echo $row["slika"]; ?>"></td>
                                    <td><?php echo $row["opis"]; ?></td>
                                    <form action="adminUrediArtikl.php?" method="GET"> 
                                    <td><input type="submit" name="uredi" value="Uredi"></td>
                                    <input type="text" name="id" value="<?php echo $row["artikl_id"]; ?>" hidden>
                                    </form>
                                    <form action="adminPregled.php?" method="POST">  
                                        <input type="text" name="id" value="<?php echo $row["artikl_id"]; ?>" hidden>          
                                        <td><input type="submit" name="izbrisi" value="Izbrisi"></td>
                                    </form>
                                </tr>
                          
                        <?php
                    }
                } 
                      
                 
                    
                   
                closeCon($conn);
                ?>
                  </table>
        </div>

        
    </body>


</html>