<?php
    session_start();  
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $_SESSION['dostava'] = $_POST['dostavljanje'];
        $_SESSION['napomena'] = $_POST['napomena'];
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
  
        
        <div id="placanje">
          <form>
          <h3>Odaberi način plaćanja:</h3>
          <input type="radio" name="placanje" value="gotovina" onclick="window.open('http://localhost/dashboard/RWA/placanjeGotovinom.php', '_self');">Plaćanje gotovinom pri preuzimanju </input>
          <br> <br><input type="radio" name="placanje" value="kartica"  onclick="window.open('http://localhost/dashboard/RWA/placanjeKarticom.php', '_self');">Kartično plaćanje </input>
          <br><br>
            
            
          </form>
        </div>
        
        <div id="trazilica" >
			<?php include 'templates/trazilicaIPoruka.php';?>
        </div>
</div>
     
    </body>


</html>