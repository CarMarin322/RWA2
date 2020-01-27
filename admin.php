<?php
    session_start();   
    $match =  false;
    $save = true;
            
    $password = $user = "";
    $err = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        if(empty($_POST["user"]) || empty($_POST["password"])){
            $err = "Neispravno korisničko ime ili lozinka";
            $save = false;
        }else{
            $user = test_input($_POST["user"]);
            $password = test_input($_POST["password"]);
           
            if($save == true){
                include_once 'db_connection.php';
                $conn = OpenConn();
                $sql = "SELECT * FROM `admin`";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($row["user"] == $user && $row["password"] == $password){
                             $match = true;
                               
                            }
                        }
                    }
                    CloseCon($conn);
                    
                    if($match){
                        $err = "Prijava uspješna";
                        unset($_SESSION['korisnikId']);
                        $_SESSION['korisnik'] = "admin";
                        unset($_SESSION['num']);
                        unset($_SESSION['numArt']);
                        unset($_SESSION['kosarica']);
                        $_SESSION["prij/odj"] = "Odjava";
                        header("Location: http://localhost/dashboard/RWA/adminPregled.php");
                        
                    } 
                    else $err = "Prijava neuspješna";
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
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stil.css">
    </head>
    
    <body>
        <div id="menu">
            <?php include 'templates/menu.php';?>
        </div>

        <div class="row">

        
        <div id="adminPrijava">
           <form action="admin.php" method="POST">
               <h3>Admin prijava:</h3> <br>
               Korisničko ime:
               <input type="text" class="ftekst"  name = "user">
               <br> <br>
               Lozinka:
               <input type="password"  class="ftekst" name = "password">
               <br>
               <br>
               <input type="submit" class="Button2" value="Prijavi se">
           </form>
           <?php
           echo $err;
           ?>
        </div>

        </div>
    </body>


</html>