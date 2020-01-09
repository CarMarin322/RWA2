<?php
    include 'db_connection.php';
    $conn = OpenCon();
    $sql = "SELECT * FROM `kategorija`";
    $result = $conn->query($sql);
   
   
  
    CloseCon($conn);
    
?>

<html>
    <head>

    </head>
    <body>
        
        <ul style="list-style-type: none;">
            <li><b>KATEGORIJE:</b></li>
            <?php 
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                    echo '<a href="prikaziKategoriju.php?catid=';
                    echo $row['kategorija_ime'];
                    echo '<li>';
                    echo $row["kategorija_ime"];
                    echo '</li> </a>';
                    }
                }
            ?>
        </ul>
    </body>
</html>
