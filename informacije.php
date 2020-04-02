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
        
        <div id="informacije">
            <H1>Informacije</H1> <br>
            Službeni email: mvm@gmail.com <br>
            Broj telefona: 0951234567 <br>
            Adresa: Nikole Tesle 4 <br>
            Grad: Rijeka <br>
            Poštanski broj: 51000 <br>



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