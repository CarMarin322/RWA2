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

        
        <div id="Poruka">
        <?php
        $poruka ='';
        function prikazi_obrazac($email="",$message="",$subject="") {  
        ?>

        <h2>Pošaljite nam poruku:</h2>

        <form class="form" action="poruka.php" method="post">

            Vaša e-mail adresa:<br>
            <input type=text class="ftekst" name=email size=30 value="<?php print($email); ?>"> <br>

            Predmet:<br>
            <input type=text class="ftekst" name=subject size=30 value="<?php print($subject); ?>"><br>

            Poruka:<br>
            <textarea rows=10 cols=50 name=message><?php print($message); ?></textarea>
            <br>

            <input type=submit class="Button2" value="Pošalji poruku">
        </form>
        <?php
        }
        if (!isset($_POST['email']) or !isset($_POST['message']) or !isset($_POST['subject'])) {
            prikazi_obrazac();
        }else {
            if (empty($_POST['message'])) {
                $poruka ="Tijelo poruke je prazno! Upisite neki tekst i obavite <i>resend</i>.";
                prikazi_obrazac($_POST['email'], $_POST['message'], $_POST['subject']);
            } else {
            if (empty($_POST['email'])) {
                $email="anonymous";
            }else{
                $email=$_POST['email'];
            }
            
            if (empty($_POST['subject'])) {
                $subject="Prazan predmet";
            }else{
                $subject=$_POST['subject'];
            }
            
            $message=$_POST['message'];
            $datum = date("Y-m-d");
            include_once 'db_connection.php';
            $conn = OpenConn();
            $sql = "INSERT INTO `poruka` (`email`, `id`, `predmet`, `poruka`, `datum`)
                    VALUES ('$email', NULL, '$subject', '$message', '$datum');";
            if($conn->query($sql)){
                echo "Poruka je poslana";
            }else {
                echo "Poruka nije poslana";
            }
          }
        }
        ?>

        <p><span style="color:tomato;"><?php echo $poruka;?></span></p>
        </div>

        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>

    </div>
    </body>


</html>