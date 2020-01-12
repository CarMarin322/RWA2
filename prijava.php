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
                    $sql = "SELECT kupac_mail, lozinka, kupac_ime FROM `kupac`";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            if($row["kupac_mail"] == $email && $row["lozinka"] == $lozinka){
                                $match = true;
                                $user = $row["kupac_ime"];
                                $_SESSION['korisnik'] = $user;
                            }
                        }
                    }
                    CloseCon($conn);
                    
                    if($match){
                        $err = "Prijava uspješna";
                        
                    } 
                    else $err = "Prijava neuspjesna";
                   
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

       

        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
        
        <div id="form">
            <b>PRIJAVA:</b> <br> <br> <br>
            <div class="alignleft">
               <b>POSTOJEĆI KORISNIK: </b> <br> <br> 
               <?php 
                if (isset($_SESSION['korisnik'])){

               
                    echo "odjavi se";
                }else{
                ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    Elektronska pošta: <input type="email" name="email"> <br> <span class="error"><?php echo $email_err;?></span> <br> <br>
                    Lozinka: <input type="password" name="lozinka"><br><br>
                    <input type="submit" value="PRIJAVI SE!"> <br> <br>
                    <span class="error"><?php echo $err;?></span>
                    </form>
                <?php
                }
            ?>
                
                
            </div>
            <div class="alignright">
                <b>NOVI KORISNIK:</b> <br> <br> <br>
                <input type="button" value="REGISTRIRAJ SE!" onclick="window.open('http://localhost/dashboard/RWA/registracija.php', '_self')">
            </div>
          
        </div>

        <script>
           
        </script>
    </body>


</html>