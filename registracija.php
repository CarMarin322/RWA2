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
        
        <div id="form" >
            <form>
                Osobni podaci:<br>
                Ime:<input type="text" id="ime"><br>
                Prezime: <input type="text" id="prezime"><br>
                Rod 
                <input type="radio" name="rod" value="muski"> Muški
                <input type="radio" name="rod" value="zenski"> Ženski<br>
                email: <input type="email" id="email"><br>
                Adresa: <input type="text" id="adresa"><br>
                Ulica: <input type="text" id="ulica"><br>
                Poštanski broj: <input type="text" id="pobr"><br>
                Grad: <input type="text" id="grad"><br>
                Zemlja: <input type="text" id="zemlja"><br>
                Kontakt: <br>
                Telefon: <input type="text" id="telefon"><br>
                Lozinka: <input type="password" id="password"><br>
                Ponovi lozinku: <input type="password" id="passcheck"><br>
                <input type="submit" value="Registriraj se!">
            </form>
        </div>
    </body>




</html>