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
        
        <div id="form">
            <form>
                email: <input type="email" id="email"><br>
                Lozinka: <input type="password" id="password"><br><br>
                <input type="submit" value="Prijavi se!">
            </form>
        </div>

        
    </body>


</html>