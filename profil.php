<?php
    session_start(); 
    include_once 'db_connection.php';
    $conn = OpenConn(); 
    
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


        
        <div id="placanje">
          <form>
          <h3>Moj profil:</h3>
          <input type="button" class="Button2" value="Narudžbe" onclick="window.open('http://localhost/dashboard/RWA/profilNarudzbe.php', '_self');">
          <br> <br><input type="button" class="Button2" value="Podaci" onclick="window.open('http://localhost/dashboard/RWA/profilPodaci.php', '_self');">
          <br><br>
            
            
          </form>
        </div>

        <div id="trazilica" >
			<?php include 'templates/trazilicaIPoruka.php';?>
        </div>
</div>
    </body>


</html>