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


        <div id="trazilica" >
			<?php include 'templates/trazilicaIPoruka.php';?>
        </div>
        
        <div id="placanje">
          <form>
          <h3>Odaberi način plaćanja:</h3>
          <input type="radio" name="placanje" value="gotovina" checked="checked" onclick="window.open('http://localhost/dashboard/RWA/placanjeGotovinom.php', '_self');">Plaćanje gotovinom pri preuzimanju </input>
          <br> <br><input type="radio" name="placanje" value="kartica" onclick="window.open('http://localhost/dashboard/RWA/placanjeKarticom.php', '_self');">Kartično plaćanje </input>
          <br><br>
            <p id="placanjeGotovinom">
            <input type="submit" value="Završi narudžbu">
            </p>
   
            </p>
          </form>
        </div>

     
    </body>


</html>