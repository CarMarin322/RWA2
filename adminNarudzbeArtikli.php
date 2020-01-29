<?php
    session_start();  
    include_once 'db_connection.php';
    $conn = OpenConn(); 
    if ($_SERVER["REQUEST_METHOD"] == "GET"){
        $id = $_GET['id'];
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


        <div id="preglednar">
        <?php
            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik'] = 'admin'){
        ?>
            <h3>Pregled narudžbe <?php echo " " . $id . "";?> </h3>
              <table id="narudzbatabela" border= 1>
              <tr>
                  <th>Naziv:</th>
                  <th>Cijena:</th>
                  <th>Popust:</th>
                  <th>Količina:</th>
                
              </tr>
      <?php
                  
          
          $sql = "SELECT * FROM `artikl` JOIN `na_artikl` USING(`artikl_id`)
          WHERE `artikl_id` IN (SELECT `artikl_id` FROM `na_artikl` WHERE `narudzba_id` = $id) 
          AND `narudzba_id` = $id";
          $result = $conn->query($sql);
              if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                      if($row["popust"] == NULL){
                          $popust = 0;
                      }else{
                        $popust = $row["popust"];
                      }
                          ?>
                      
                            
                          <tr>
                              <td><?php echo $row["artikl_naziv"]; ?></td>
                              <td><?php echo $row["artikl_cijena"]; ?></td>
                              
                              <td><?php echo $popust ?> %</td>
                              <td><?php echo $row["kolicina"]; ?></td>
                              
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