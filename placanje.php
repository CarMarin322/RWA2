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


        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
        
        <div id="informacije">
          <form action="nastavakPlacanje" method = "POST">
          <h3>Odaberi način plaćanja:</h3>
          <input type="radio" name="placanje" value="gotovina">Plaćanje gotovinom pri preuzimanju </input>
          <br> <br><input type="radio" name="placanje" value="kartica">Kartično plaćanje </input>
          <br><br>
          <input type="submit" value="Nastavi">
          </form>
        </div>

        
    </body>


</html>