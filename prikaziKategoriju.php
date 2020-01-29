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

        <div class="row">

        <div id="kategorije" >		
		<?php include 'templates/kategorije.php'?>
        </div>


        
        <div id="prikazKategorija">
                <?php
                    
                    $catid = "";
                    $catname = $_GET['catName'];
                    $num = $_SESSION["artPerPage"];
                    $page = $_GET['page'];
                    $conn = OpenConn();
                    $sql = "SELECT * FROM `kategorija`";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            if($row["kategorija_ime"] == $_GET['catName']){
                                $catid = $row["kategorija_id"];
                            }
                        }
                    } 
                    if($_GET['catName'] == "Prijenosna računala") $catid = 1;  
                    
                    if($page == 1){
                        $sql = "SELECT * FROM `artikl` WHERE `artikl_kategorija` = $catid
                                LIMIT $num";
                    }else{
                        $limit = ($page - 1) * $num;
                        $sql = "SELECT * FROM `artikl` WHERE `artikl_kategorija` = $catid
                        LIMIT $limit, $num";
                    }
                   
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                           
                ?>

                <div id="artikl">
                
                <a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>"><img class="image" src="<?php echo $row["slika"]; ?>" alt="">  </a><br>
                <a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>">  <span><?php echo $row["artikl_naziv"]; ?> </span></a> <br> 
                <?php
                if($row["popust"] == NULL || $row["popust"] == 0){
                ?>
                <b>Cijena: </b> <span><?php echo $row["artikl_cijena"]; ?> kn</span> <br>
                <?php
                }else{
                   
					$novaCijena = $row["artikl_cijena"] * (1 -($row["popust"] / 100));
				?>

					<b>Cijena: </b> <strike><?php echo $row["artikl_cijena"]; ?> kn</strike> <br> <span><?php echo $novaCijena; ?> kn</span>
					<br>
					<span style="color:tomato;"><b>Popust: <?php echo $row["popust"]; ?> %</b></span>
                <?php
                    
                }
                ?>
                
                <div class="overlay">
    <div class="text">
                <br> <a href="prikaziKategoriju.php?page=<?php echo $page; ?>&catName=<?php echo $_GET['catName']; ?>&cart=<?php echo $row["artikl_id"]?>">
                <button class="myButton">Spremi u košaricu</button></a></div>
  </div>
                </div>
                
                

                <?php
                    
                        }
                    }  
                   
                ?>
        </div>
        <div id="trazilica">
		<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
                </div>
        
        <div id="brstr">
        <br> <br> <br>
            <?php
             $sql = "SELECT COUNT(*) AS broj FROM `artikl` WHERE `artikl_kategorija` = $catid";
             $result = $conn->query($sql);
             $row = $result->fetch_assoc();
             $count = $row["broj"];
             $pages = ceil($count / $num);
             

             for($i = 1; $i <= $pages; $i++){
                 ?>
                 <a href="prikaziKategoriju.php?catName=<?php echo $catname; ?>&page=<?php echo $i; ?>"><span style="color:rgb(69, 196, 255);">
                 <?php echo $i; ?></span></a>
                 
                 <?php
                
             }
            
            closeCon($conn);
            ?>
        </div>
    </body>


</html>