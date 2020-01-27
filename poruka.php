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
        function prikazi_obrazac($email="",$message="",$subject="") {  
        ?>

        <h2>Pošaljite nam email:</h2>

        <form class="form" action="poruka.php" method="post">

            Vaša e-mail adresa:<br>
            <input type=text class="ftekst" name=email size=30 value="<?php print($email); ?>"> <br>

            Predmet:<br>
            <input type=text class="ftekst" name=subject size=30 value="<?php print($subject); ?>"><br>

            Poruka:<br>
            <textarea rows=10 cols=50 name=message><?php print($message); ?></textarea>
            <br>

            <input type=submit class="Button2" value="Posalji E-mail">
        </form>
        <?php
        }
        if (!isset($_POST['email']) or !isset($_POST['message']) or !isset($_POST['subject'])) {
            prikazi_obrazac();
        }else {
            if (empty($_POST['message'])) {
                print("Tijelo poruke je prazno! Upisite neki tekst i obavite <i>resend</i>.");
                prikazi_obrazac($_POST['email'], $_POST['message'], $_POST['subject']);
            } else {
            if (empty($_POST['email'])) {
                $email="anonymous";
            }
            
            if (empty($_POST['subject'])) {
                $subject="Prazan predmet";
            }
        
            $sent = mail("valentina20202@gmail.com", $_POST['subject'], $_POST['message'], "From: " . $_POST['email']);
        
            if ($sent) {
                print("<H1>Vaša poruka je poslana.</H1>");
            } else {
                print("<p>Poslužitelj nije u mogućnosti poslati vaš e-mail.");
            }
          }
        }
        ?>
        </div>

        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>

    </div>
    </body>


</html>