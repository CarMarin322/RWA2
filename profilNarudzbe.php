<?php
    session_start();  
    include_once 'db_connection.php';
    $conn = OpenConn(); 
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
          <form>
          <h3>Moj profil:</h3>
          <input type="button" value="Narudžbe" onclick="window.open('http://localhost/dashboard/RWA/profilNarudzbe.php', '_self');">
          <br> <br><input type="button" value="Podaci" onclick="window.open('http://localhost/dashboard/RWA/profilPodaci.php', '_self');">
          <br><br>
            
            
          </form>

        </div>

        <div>
            <h3>Pregled dosadašnjih narudžbi:</h3>
              <table border= 1>
              <tr>
                  <th>Datum:</th>
                  <th>Broj narudžbe:</th>
                  <th>Status:</th>
                  <th>Vrijednost:</th>
                  <th>Opcije:</th>
              </tr>
      <?php
                  
          
          $sql = "SELECT * FROM `narudzba`";
          $result = $conn->query($sql);
              if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                          ?>
                      
                            
                          <tr>
                              <td><?php echo $row["datum"]; ?></td>
                              <td><?php echo $row["narudzba_id"]; ?></td>
                              <td><?php echo $row["status"]; ?></td>
                              <td><?php echo $row["ukupno"]; ?></td>
                            
                              
                              <form action="profilNarudzbeArtikli.php" method="GET">  
                                   <input type="text" name ="id" value="<?php echo $row["narudzba_id"]; ?>" hidden>    
                                  <td><input type="submit"  value="Pogledaj narudžbu"></td>
                              </form>
                          </tr>
                          
                    
                      <?php
                  }
                }
            ?>
        </div>

     
    </body>


</html>