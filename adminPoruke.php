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
            <h3>Pregled Poruka:</h3>
              <table id="preglednarudzbatabela" border= 1>
              <tr>
                  <th>Datum:</th>
                  <th>e-mail:</th>
                  <th>Predmet:</th>
                  <th>Opcije:</th>
              </tr>
      <?php
                  
          
          $sql = "SELECT * FROM `poruka`";
          $result = $conn->query($sql);
              if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                          ?>
                      
                            
                          <tr>
                              <td><?php echo $row["datum"]; ?></td>
                              <td><?php echo $row["email"]; ?></td>
                              <td><?php echo $row["predmet"]; ?></td>
                            
                              
                              <form action="adminPorukaPregled.php" method="GET">  
                                   <input type="text" name ="id" value="<?php echo $row["id"]; ?>" hidden>    
                                  <td><input class="myButton" type="submit"  value="Pogledaj poruku"></td>
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