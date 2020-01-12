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

        <div id="kategorije" >		
			<?php include 'templates/kategorije.php'?>
        </div>

        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
        
        <div id="prikazArtikl">
        <?php 
            $id = $_GET['artId'];
            $conn = OpenConn();
            $sql = "SELECT * FROM `artikl` WHERE `artikl_id` = $id";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){

            
        ?>
            <img src="<?php echo $row["slika"]; ?>" alt=""> <br>
            <b>Naziv: </b> <span><?php echo $row["artikl_naziv"]; ?> </span> <br> 
            <b>Cijena: </b> <span><?php echo $row["artikl_cijena"]; ?> kn</span> <br>
            <b>Specifikacije: </b> <br> </b> <span><?php echo $row["opis"]; ?></span>
            <form action="dodajUKosaricu.php?artId=<?php echo $row["artikl_id"];?>" method="GET">
                <input type="submit" value="kosarica">
            </form>
         

        <?php
            }
        } 
            if(isset($_GET["kosarica"])){
                echo "spremljeno";
            }
            closeCon($conn);

        ?>
           
        </div>

        
    </body>


</html>