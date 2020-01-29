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
            <h3>Pregled Poruke:</h3>
              
      <?php
                  
          
          $sql = "SELECT * FROM `poruka`
                  WHERE `id` = $id";
          $result = $conn->query($sql);
              if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                          ?>
                    
                              
                           
                          
                            <p><u>email:</u> <?php echo $row["email"]; ?></p>
                            
                            <p><u>Predmet:</u> <?php echo $row["predmet"]; ?></p>
                            
                            <p><u>Sadržaj:</u></p>
                            <p><?php echo $row["poruka"]; ?></p>
                              
                          
                    
                      <?php
                  }
                }
            ?>
          
            <?php
            }else{
                echo "Niste ovlašteni pristupiti ovoj stranici";
            }
        ?>
        </div>
        

        

            </div>
    </body>


</html>