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

        
        <div id="AdminPregled">
        <h3>Pregled artikala: </h3> <br>
        <form action="adminPregled.php">
            <input type="submit" name="dodaj" value="Dodaj artikal">
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
                    
            include 'db_connection.php';
            $conn = OpenConn();
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
                                    <form action="adminPregled.php" method="POST">
                                        <td><input type="submit" name="uredi" value="Uredi"></td>
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