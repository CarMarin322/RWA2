<html>
    <head>
    <link rel="stylesheet" type="text/css" href="stil.css">


    </head>
    <a  href="naslovna.php"><img class="kosara" src="slike/logo1.png" width="150" height="150" > </a>

        
            <?php 
            $korisnik = "";
            $profil = "";
                if (isset($_SESSION['korisnik'])){
                    $korisnik = $_SESSION['korisnik'];
                    if($_SESSION['korisnik'] != 'admin'){
                        $profil = "Moj profil";
                    }
                }

                
                     
                    
                    
                if (!isset($_SESSION['prij/odj'])){
                    $_SESSION['prij/odj'] = "Prijava";
                }
            ?>
        <span><?php echo $korisnik;?></span>
        <?php
        if(isset($_SESSION['korisnik']) && $_SESSION['korisnik'] != 'admin'){
?>
            <a  href="profil.php"><button class="Button2"> <?php echo $profil;?> </button></a>
        <?php
        }
        ?>
        <p class="textformat"> <?php if (isset($_SESSION['num'])){
                    echo $_SESSION['num'];
                } ?> </p>
        <a class="alignright" href="kosarica.php"> <img class="kosara" src="slike/kart4.png" width="65" height="55"> </a>
        
        <a class="alignright" href="registracija.php"><button class="myButton"> Registracija</button></a>
        <a class="alignright" href="prijava.php"><button class="myButton"> <?php echo $_SESSION["prij/odj"];?> </button></a>
        <a class="alignright" href="informacije.php"><button class="myButton"> Informacije </button></a>
</html>


