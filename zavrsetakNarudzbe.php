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

<div class="row">

        <div id="kategorije" >		
			<?php include 'templates/kategorije.php'?>
        </div>

        
        
        <div id="Zavrsetak">
          <span style="color:rgb(69, 196, 255);"> Uspješno ste izvršili narudžbu! <br> :)</span>
        </div>
        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
</div>
        
    </body>


</html>