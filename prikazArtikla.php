<?php
    session_start();   
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
            <br> <a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>&cart=<?php echo $row["artikl_id"]?>"><button>Spremi u košaricu</button></a>
         

        <?php
            }
        } 
       
            closeCon($conn);

        ?>
           
        </div>

        
    </body>


</html>