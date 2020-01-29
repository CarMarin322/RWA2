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

        
        

        <div id="preglednar">
        <?php
            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik'] = 'admin'){
        ?>
            <h3>Pregled narudžbi:</h3>
              <table id="preglednarudzbatabela" border= 1>
              <tr>
                  <th>Datum:</th>
                  <th>Broj narudžbe:</th>
                  <th>Id kupca:</th>
                  <th>Status:</th>
                  <th>Vrijednost:</th>
                  <th>Dostava:</th>
                  <th>Napomena:</th>
                  <th>Plaćanje:</th>
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
                              <td><?php echo $row["kupac_id"]; ?></td>
                              <td><?php echo $row["status"]; ?></td>
                              <td><?php echo $row["ukupno"]; ?></td>
                              <td><?php echo $row["dostava"]; ?></td>
                              <td><?php echo $row["napomena"]; ?></td>
                              <td><?php echo $row["placanje"]; ?></td>
                            
                              
                              <form action="adminNarudzbeArtikli.php" method="GET">  
                                   <input type="text" name ="id" value="<?php echo $row["narudzba_id"]; ?>" hidden>    
                                  <td><input class="myButton" type="submit"  value="Pogledaj narudžbu"></td>
                              </form>
                          </tr>
                          
                    
                      <?php
                  }
                }
            ?>
            </table>
            <?php
            }else{
                echo "Niste ovlašteni pristupiti ovoj stranici";
            }
        ?>
        </div>
        

        

            </div>
    </body>


</html>