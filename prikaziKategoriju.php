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
                <a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>"><img src="<?php echo $row["slika"]; ?>" alt="">  </a><br>
                <a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>"> <b>Naziv: </b> <span><?php echo $row["artikl_naziv"]; ?> </span></a> <br> 
                <b>Cijena: </b> <span><?php echo $row["artikl_cijena"]; ?> kn</span> <br>
                <br> <a href="prikaziKategoriju.php?page=<?php echo $page; ?>&catName=<?php echo $_GET['catName']; ?>&cart=<?php echo $row["artikl_id"]?>">
                <button>Spremi u košaricu</button></a>
                </div>
                

                <?php
                    
                        }
                    }  
                   
                ?>
        </div>
        
        <div>
        <br> <br> <br>
            <?php
             $sql = "SELECT COUNT(*) AS broj FROM `artikl` WHERE `artikl_kategorija` = $catid";
             $result = $conn->query($sql);
             $row = $result->fetch_assoc();
             $count = $row["broj"];
             $pages = ceil($count / $num);
             

             for($i = 1; $i <= $pages; $i++){
                 ?>
                 <a href="prikaziKategoriju.php?catName=<?php echo $catname; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                 <?php
                
             }
            
            closeCon($conn);
            ?>
        </div>
    </body>


</html>