<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stil.css" media="all">
    
    </head>

    <body>
        
        <?php
            $match =  $save = false;
            
            $email = $lozinka = "";
            $email_err = $lozinka_err = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = test_input($_POST["email"]);
                $lozinka = test_input($_POST["lozinka"]);
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            if($save){
                include 'db_connection.php';
                $conn = OpenCon();
                $sql = "SELECT kupac_mail, lozinka FROM `kupac`";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["kupac_mail"] == $email && $row["lozinka"] == $lozinka){
                          $match = true;
                        }
                    }
                }
                if($match) echo "prijava uspjesna";
                else echo "prijava neuspjesna";
            }
        
        ?>
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
            <div id=prijava_lijevo>
                Postojeći korisnik: <br> <br> 
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    Elektronska pošta: <input type="email" name="email"><br> <br>
                    Lozinka: <input type="password" name="lozinka"><br><br>
                    <input type="submit" value="Prijavi se!">
                </form>
            </div>
            <div id="prijava_desno">
            </div>
          
        </div>

        
    </body>


</html>