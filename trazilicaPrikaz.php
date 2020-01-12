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
        
        <div id="prikazKategorija">
            <?php
                $trazi = $_GET["trazilica"];
                $conn = OpenConn(); $sql = "SELECT * FROM `artikl`";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($trazi == "") break;
                        if(stristr($row["artikl_naziv"], $trazi)){
                            
                  
            ?>
            
            <div id="artikl">
                <a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>"><img src="<?php echo $row["slika"]; ?>" alt="">  </a><br>
                <a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>"> <b>Naziv: </b> <span><?php echo $row["artikl_naziv"]; ?> </span></a> <br> 
                <b>Cijena: </b> <span><?php echo $row["artikl_cijena"]; ?> kn</span> <br>
                <br> <a href="kosarica.php"><button>Spremi u košaricu</button></a>
            </div>
            


            <?php
                        }
                    }
                } 
                closeCon($conn);
            ?>
        </div>


        
    </body>


</html>