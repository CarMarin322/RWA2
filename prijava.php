<?php
    session_start();    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stil.css" media="all">
    
    </head>

    <body>
        
        <?php
            
            $match =  false;
            $save = true;
            
            $email = $lozinka = $user = "";
            $email_err = $err = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if(isset($_POST['odjava'])){
                    unset($_SESSION['korisnik']);
                    unset($_SESSION['num']);
                    unset($_SESSION['numArt']);
                    unset($_SESSION['kosarica']);
                    $_SESSION["prij/odj"] = "Prijava";
                }else{

                if(empty($_POST["email"])){
                    $email_err = "Molimo vas unesite vaš email";
                    $save = false;
                }else{
                    $email = test_input($_POST["email"]);
                   
                }
                $lozinka = test_input($_POST["lozinka"]);
           

                if($save == true){
                    include_once 'db_connection.php';
                    $conn = OpenConn();
                    $sql = "SELECT kupac_mail, lozinka, kupac_ime,kupac_id FROM `kupac`";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            if($row["kupac_mail"] == $email && $row["lozinka"] == $lozinka){
                                $match = true;
                                $user = $row["kupac_ime"];
                                $userId = $row["kupac_id"];
                               
                            }
                        }
                    }
                    CloseCon($conn);
                    
                    if($match){
                        $err = "Prijava uspješna";
                        
                        $_SESSION['korisnik'] = $user;
                        $_SESSION['korisnikId'] = $userId;
                        $_SESSION["prij/odj"] = "Odjava";
                        header("Location: http://localhost/dashboard/RWA/naslovna.php");
                    } 
                    else $err = "Prijava neuspjesna";
                }
                }
            }
            
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        
        ?>
        <div id="menu">
            <?php include 'templates/menu.php';?>
        </div>

       
        <div class="row">
        



        <div class="form2">
            


               <b>POSTOJEĆI KORISNIK: </b> <br> <br> 
               <?php 
                if (isset($_SESSION['korisnik'])){

                    echo 'Dobrodošao/la ' . $_SESSION["korisnik"];
                ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <br> <br><input class="Button2" type="submit" name="odjava" value="ODJAVI  SE!"> <br>
                    </form>
                <?php
                }else{
                ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    Elektronska pošta:<br> <input type="email" name="email" class="ftekst"> <br> <span class="error"><?php echo $email_err;?></span> <br>
                    Lozinka:<br> <input type="password" name="lozinka" class="ftekst" ><br><br>
                    <input type="submit" class="Button2" value="PRIJAVI SE!"> <br> <br>
                    <span class="error"><?php echo $err;?></span>
                    </form>
                    

                
                
            
            
                <b>NOVI KORISNIK:</b> <br>  <br>
                <button class="Button3"  onclick="window.open('http://localhost/dashboard/RWA/registracija.php', '_self')"> REGISTRIRAJ SE! </button>
                <br> <br>
                <a href="admin.php"><h6>Admin prijava</h6></a>
                <?php
                }
            ?>
           
          
        </div>


            </div>
        <script>
           
        </script>
    </body>


</html>