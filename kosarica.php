<?php
    session_start();  
   
    if(isset($_SESSION['kosarica'])) {          
            
            if(isset($_GET['kol'])){
                if($_GET['kol'] == '-'){
                    $_SESSION['numArt'][$_GET['n']] -= 1;
                    if($_SESSION['numArt'][$_GET['n']] < 0){
                        $_SESSION['numArt'][$_GET['n']] = 0;
                    }
                    $_SESSION['num'] -= 1;
                    if($_SESSION['num'] < 0){
                        $_SESSION['num'] = 0;
                    }
                
                }
                if($_GET['kol'] == 'plus'){
                    $_SESSION['numArt'][$_GET['n']] += 1;
                    $_SESSION['num'] += 1;      
                
                }
            
            }
            if(isset($_GET['izbaci'])){
                $_SESSION['num'] -= $_SESSION['numArt'][$_GET['izbaci']];
                $_SESSION['numArt'][$_GET['izbaci']] = 0;
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

       

        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
        
        <div id="kosarica">
        <?php
            
           
            if(isset($_SESSION['kosarica'])){
                
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='GET'>
            <table id="tablicaKosarice" border=1>
            <tr>
            <th>Artikl</th>
            <th></th>
            <th>Cijena</th>
            <th></th>
            <th>Količina</th>
            <th></th>
            </tr>
         
           <?php 
                
            
                    include_once 'db_connection.php';

                    $conn = OpenConn();
                    $ukupno = 0;
                    for($i = 0; $i < count($_SESSION['kosarica']); $i++){

                        $kosara = $_SESSION['kosarica'][$i];
                        if($_SESSION['numArt'][$i] == 0) continue;
                        $sql = "SELECT artikl_id, artikl_naziv, artikl_cijena FROM `artikl`
                                WHERE artikl_id = '$kosara' ";
                        $result = $conn->query($sql);
                        if($result && $result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                $ukupno += $row['artikl_cijena']*$_SESSION['numArt'][$i];
                            ?>
                            <tr>
                            <th><?php echo $row['artikl_naziv'];?></th>
                            <th></th>
                            <th><?php echo $row['artikl_cijena']  . 'kn' ;?></th>
                            <th></th>
                            <th>
                            <input type="button" value="-" onclick="window.open('http://localhost/dashboard/RWA/kosarica.php?kol=-&n=<?php echo $i;?>', '_self')">
                           <?php echo $_SESSION['numArt'][$i];?> 
                           <input type="button" value="+" onclick="window.open('http://localhost/dashboard/RWA/kosarica.php?kol=plus&n=<?php echo $i;?>', '_self')">
                            </th>
                            <th><input type="button" value="Izbaci" onclick="window.open('http://localhost/dashboard/RWA/kosarica.php?izbaci=<?php echo $i;?>', '_self')">
                            </th>
                            
                            </tr>
                            
                            
                            <?php
                        }
                    }
                    }
                
                   
               
           ?>
           
           </table>
           <br>
           <br>
           <p>Ukupna Cijena:<?php echo $ukupno. ' kn';?></p>
           <br>
           <br>
           <br>
           <form action="naslovna.php" method="post">
                <button type="submit">Povratak na pregled ponude</button>
           </form>
           <form  action="narudzba.php" method="post">
                <button type="submit">Nastavak na odabir dostave</button>
           </form>
           <?php
            }else{
        
                ?>
               <p> Kosarica je prazna</p>  <br>
                <a href="naslovna.php">Povratak na pregled ponude</a>
                <?php
            }
           ?>
        </div>

        
    </body>


</html>