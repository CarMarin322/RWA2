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


        
        <div id="adminPrijava">
           <form action="adminPregled.php" method="POST">
               <h3>Admin prijava:</h3> <br>
               Korisničko ime:
               <input type="text" name = "user">
               <br> <br>
               Lozinka:
               <input type="password" name = "password">
               <br>
               <br>
               <input type="submit" value="Prijavi se">
           </form>
        </div>

        
    </body>


</html>