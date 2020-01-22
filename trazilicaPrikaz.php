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
                <br> <a href="trazilicaPrikaz.php?trazilica=<?php echo $trazi?>&cart=<?php echo $row["artikl_id"]?>"><button>Spremi u košaricu</button></a>
            </div>
            


            <?php
                        }
                    }
                } 

                if(isset($_GET["cart"])){
                    if(!isset($_SESSION['num'])){
                        $_SESSION['num']=1;
                    }
                    else{
                        $_SESSION['num'] += 1;
                    }
                    $cart = $_GET["cart"];
                    $postoji = false;
                    if(!isset($_SESSION['kosarica'])){
                        $_SESSION['kosarica'] = array();
                        $_SESSION['numArt'] = array();
                        array_push($_SESSION['kosarica'], $cart);
                        array_push($_SESSION['numArt'], 1);
                    }else{
                        for($i = 0; $i < count($_SESSION['kosarica']); $i++){
                            if($_SESSION['kosarica'][$i] == $cart){
                                $_SESSION['numArt'][$i] += 1;
                                $postoji = true;
                            }
                        }
                        if(!$postoji){
                            array_push($_SESSION['kosarica'], $cart);
                            array_push($_SESSION['numArt'], '1');
                        }
                    }
                }
                closeCon($conn);
            ?>
        </div>


        
    </body>


</html>