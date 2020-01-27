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
		<div id=menu>
			<?php
			include 'templates/menu.php';?>
		</div>

		<div class="row">

		<div id="kategorije">		
			<?php include 'templates/kategorije.php'?>
		</div>

		

		<div id="naslovna">
			<?php
			$conn = OpenConn();
			$sql = "SELECT * FROM `artikl`
					WHERE `popust` IS NOT NULL";
            $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
						?>
						<div id="artikl">
						<a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>"><img class="image" src="<?php echo $row["slika"]; ?>" alt="">  </a><br>
						<a href="prikazArtikla.php?artId=<?php echo $row["artikl_id"]?>"> <b>Naziv: </b> <span><?php echo $row["artikl_naziv"]; ?> </span></a> <br> 
						<?php
							$novaCijena = $row["artikl_cijena"] * (1 -($row["popust"] / 100));
						?>
						<b>Cijena: </b> <strike><?php echo $row["artikl_cijena"]; ?> kn</strike> <br> <span><?php echo $novaCijena; ?> kn</span>
						<br>
						<span style="color:tomato;"><b>Popust: <?php echo $row["popust"]; ?> %</b></span>
						<div class="overlay">
    <div class="text">
						<br> <a href="naslovna.php?cart=<?php echo $row["artikl_id"]?>">
						<button class="myButton">Spremi u košaricu</button></a>
					</div>
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
							<br>
							<br>
							<br>
							<br>
							<br>
							<br>
        </div>
		
	</body>
</html>