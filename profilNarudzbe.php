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

<div class="row">


        
        <div id="placanje2">
          <form>
          <h3>Moj profil:</h3>
          <input type="button" class="Button2" value="Narudžbe" onclick="window.open('http://localhost/dashboard/RWA/profilNarudzbe.php', '_self');">
          <br> <br><input type="button" class="Button2" value="Podaci" onclick="window.open('http://localhost/dashboard/RWA/profilPodaci.php', '_self');">
          <br><br>
            
            
          </form>

        </div>

        <div id="preglednar">
            <h3>Pregled dosadašnjih narudžbi:</h3>
              <table id="preglednarudzbatabela" border= 1>
              <tr>
                  <th>Datum:</th>
                  <th>Broj narudžbe:</th>
                  <th>Status:</th>
                  <th>Vrijednost:</th>
                  <th>Opcije:</th>
              </tr>
      <?php
                  
          $id = $_SESSION["korisnikId"];
          $sql = "SELECT * FROM `narudzba`
                  WHERE `kupac_id` = $id";
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
                                  <td><input class="myButton" type="submit"  value="Pogledaj narudžbu"></td>
                              </form>
                          </tr>
                          
                    
                      <?php
                  }
                }
            ?>
            </table>
        </div>

        <div id="trazilica" >
			<?php include 'templates/trazilicaIPoruka.php';?>
        </div>

            </div>
    </body>


</html>