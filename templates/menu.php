<html>
    <head>

    </head>
    <body>
    <a href="naslovna.php"><img src="slike/TempLogo.png" width="150" height="150" align="center"> </a>

        
            <?php 
                if (isset($_SESSION['korisnik'])){
                    echo $_SESSION['korisnik'];
                    if($_SESSION['korisnik'] != 'admin'){
                    echo '<a href="profil.php">Moj profil</a>';
                    }
                }

                
                     
                    
                    
                if (!isset($_SESSION['prij/odj'])){
                    $_SESSION['prij/odj'] = "Prijava";
                }
            ?>
        <p class="alignright"> <?php if (isset($_SESSION['num'])){
                    echo $_SESSION['num'];
                } ?> </p>
        <a class="alignright" href="kosarica.php"> <img src="slike/shopping_cart.png" width="20" height="20"> </a>
        
        <a class="alignright" href="registracija.php"> Registracija</a>
        <a class="alignright" href="prijava.php"> <?php echo $_SESSION["prij/odj"];?> </a>
        <a class="alignright" href="informacije.php"> Informacije </a>
    </body>
</html>


