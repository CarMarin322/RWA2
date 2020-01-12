<?php
    session_start();    
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="stil.css">
    </head>
    
    <body>
    <?php 
        $save = true;           
        $ime_err = $prezime_err = $rod_err = $email_err = $lozinka_err = $provjera_err = $rodenje_err = $telefon_err = $grad_err = $zemlja_err = $pobr_err = $datum_err = "";
        $ime = $prezime = $rod = $dan = $mjesec = $godina = $email = $ulica = $pobr = $grad = $zemlja = $telefon = $lozinka = $provjera_lozinke = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST["ime"])){
        
                $ime_err = "Molimo vas unesite vaše ime";
               $save = false;
            }else{
                $ime = test_input($_POST["ime"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$ime)) {
                    $ime_err = "Samo slova i razmak su dopušteni";
                    $save = false;
                }
            }

            if(empty($_POST["prezime"])){
                $prezime_err = "Molimo vas unesite vaše prezime";
                $save = false;
            }else{
                $prezime = test_input($_POST["prezime"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$prezime)) {
                    $prezime_err = "Samo slova i razmak su dopušteni";
                    $save = false;
                }
            }

            if(empty($_POST["rod"])){
                $rod_err = "Molimo vas unesite vaš rod";
                $save = false;
            }else{
                $rod = test_input($_POST["rod"]);
            }

            if(empty($_POST["email"])){
                $email_err = "Molimo vas unesite vaš email";
                $save = false;
            }else{
                $email = test_input($_POST["email"]);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $email_err = "Nevažeći email";
                    $save = false;
                }
               
            }

            if(empty($_POST["lozinka"])){
                $lozinka_err = "Molimo vas unesite lozinke";
                $save = false;
            }else{
                $lozinka = test_input($_POST["lozinka"]);
               
            }

            if(empty($_POST["provjera_lozinke"])){
                $provjera_err = "Molimo vas unesite lozinku ponovo";
                $save = false;
            }else{
               
                $provjera_lozinke = test_input($_POST["provjera_lozinke"]);
                if($lozinka != $provjera_lozinke){
                    $provjera_err = "Lozinke su različite";
                    $save = false;
                }
            }
            
            $telefon = test_input($_POST["telefon"]);
            if(is_numeric($telefon) == false && $telefon != ""){
                $telefon_err = "Ne možete imati slova unutar broja telefona";
                $save = false;
            }     
                    
            $ulica = test_input($_POST["ulica"]);
            $pobr = test_input($_POST["pobr"]);
            if(is_numeric($pobr) == false && $pobr != ""){
                $pobr_err = "Ne možete imati slova unutar poštanskog broja";
                $save = false;
            } 
            $grad = test_input($_POST["grad"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$grad)) {
                $grad_err = "Samo slova i razmak su dopušteni";
                $save = false;
            }
            $zemlja = test_input($_POST["zemlja"]);
            if (!preg_match("/^[a-zA-Z ]*$/",$zemlja)) {
                $zemlja_err = "Samo slova i razmak su dopušteni";
                $save = false;
            }
            
            $godina = test_input($_POST["godina"]);
            $mjesec = test_input($_POST["mjesec"]);
            $dan = test_input($_POST["dan"]);
            if($dan == 31 && ($mjesec % 2 == 0)){
                $datum_err = "Nepostojeći datum";
                $save = false;
            }
            if($mjesec == 2){
                if($dan == 30 || ($dan == 29 && !is_leap_year($godina))){
                    $datum_err = "Nepostojeći datum"; 
                    $save = false;
                }
            }
            include_once 'db_connection.php';
            $conn = OpenConn();
            $sql = "SELECT kupac_mail FROM `kupac`";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($row["kupac_mail"] == $email){
                        $email_err = "Već se prijavljeni s ovom email adresom";
                        $save = false;
                    }
                }
            }
                    
            if($save == true){
              

                $sql = "INSERT INTO `kupac` (`kupac_id`, `kupac_ime`, `kupac_prezime`, `kupac_mail`, `rod`, `ulica`, `postanski`, `grad`, `zemlja`, `telefon`, `lozinka`, `rođenje`) 
                VALUES (NULL, '$ime', '$prezime', '$email', '$rod', '$ulica', '$pobr', '$grad', '$zemlja', '$telefon', '$lozinka', '$godina-$mjesec-$dan')";

                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                
                CloseCon($conn);
            }        

        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        function is_leap_year($year){
            return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));
        }

        ?>
        <div id="menu">
            <?php include 'templates/menu.php';?>
        </div>
        
        <div id="trazilica">
			<?php include 'templates/trazilicaIPoruka.php'?>
        </div>
        
        <div id="form" >
            <b>REGISTRACIJA:</b> <br> <br> <br>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
               <b>Osobni podaci:</b> <br><br>
                *Ime:  <input type="text" name="ime">
                <span class="error"><?php echo $ime_err;?></span><br>
                *Prezime:  <input type="text" name="prezime">
                <span class="error"><?php echo $prezime_err;?></span><br>
                
                *Rod: 
                <input type="radio" name="rod" value="muski"> Muški
                <input type="radio" name="rod" value="zenski"> Ženski
                <span class="error"><?php echo $rod_err;?></span>
                <br>
                Datum rođenja:
                <select name="dan">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>
                <select name="mjesec">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <select name="godina">
                    <option value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                    <option value="2009">2009</option>
                    <option value="2008">2008</option>
                    <option value="2007">2007</option>
                    <option value="2006">2006</option>
                    <option value="2005">2005</option>
                    <option value="2004">2004</option>
                    <option value="2003">2003</option>
                    <option value="2002">2002</option>
                    <option value="2001">2001</option>
                    <option value="2000">2000</option>
                    <option value="1999">1999</option>
                    <option value="1998">1998</option>
                    <option value="1997">1997</option>
                    <option value="1996">1996</option>
                    <option value="1995">1995</option>
                    <option value="1994">1994</option>
                    <option value="1993">1993</option>
                    <option value="1992">1992</option>
                    <option value="1991">1991</option>
                    <option value="1990">1990</option>
                    <option value="1989">1989</option>
                    <option value="1988">1988</option>
                    <option value="1987">1987</option>
                    <option value="1986">1986</option>
                    <option value="1985">1985</option>
                    <option value="1984">1984</option>
                    <option value="1983">1983</option>
                    <option value="1982">1982</option>
                    <option value="1981">1981</option>
                    <option value="1980">1980</option>
                    <option value="1979">1979</option>
                    <option value="1978">1978</option>
                    <option value="1977">1977</option>
                    <option value="1976">1976</option>
                    <option value="1975">1975</option>
                    <option value="1974">1974</option>
                    <option value="1973">1973</option>
                    <option value="1972">1972</option>
                    <option value="1971">1971</option>
                    <option value="1970">1970</option>
                    <option value="1969">1969</option>
                    <option value="1968">1968</option>
                    <option value="1967">1967</option>
                    <option value="1966">1966</option>
                    <option value="1965">1965</option>
                    <option value="1964">1964</option>
                    <option value="1963">1963</option>
                    <option value="1962">1962</option>
                    <option value="1961">1961</option>
                    <option value="1960">1960</option>
                    <option value="1959">1959</option>
                    <option value="1958">1958</option>
                    <option value="1957">1957</option>
                    <option value="1956">1956</option>
                    <option value="1955">1955</option>
                    <option value="1954">1954</option>
                    <option value="1953">1953</option>
                    <option value="1952">1952</option>
                    <option value="1951">1951</option>
                    <option value="1950">1950</option>
                    <option value="1949">1949</option>
                    <option value="1948">1948</option>
                    <option value="1947">1947</option>
                    <option value="1946">1946</option>
                    <option value="1945">1945</option>
                    <option value="1944">1944</option>
                    <option value="1943">1943</option>
                    <option value="1942">1942</option>
                    <option value="1941">1941</option>
                    <option value="1940">1940</option>
                    <option value="1939">1939</option>
                    <option value="1938">1938</option>
                    <option value="1937">1937</option>
                    <option value="1936">1936</option>
                    <option value="1935">1935</option>
                    <option value="1934">1934</option>
                    <option value="1933">1933</option>
                    <option value="1932">1932</option>
                    <option value="1931">1931</option>
                    <option value="1930">1930</option>

                </select>
                <span class="error"><?php echo $datum_err;?></span>
                <br>
               *email: <input type="email" name="email">
               <span class="error"><?php echo $email_err;?></span><br> <br>
                <b> Adresa: </b><br> <br>
                Ulica: <input type="text" name="ulica"><br>
                Poštanski broj: <input type="text" name="pobr">
                <span class="error"><?php echo $pobr_err;?></span><br>
                Grad: <input type="text" name="grad">
                <span class="error"><?php echo $grad_err;?></span><br>
                Zemlja: <input type="text" name="zemlja">
                <span class="error"><?php echo $zemlja_err;?></span><br><br>
                 <b>Kontakt:</b>  <br><br>
                Telefon: <input type="text" name="telefon">
                <span class="error"><?php echo $telefon_err;?></span><br> <br> <br>
                *Lozinka: <input type="password" name="lozinka">
                <span class="error"><?php echo $lozinka_err;?></span><br>
                *Ponovi lozinku: <input type="password" name="provjera_lozinke">
                <span class="error"><?php echo $provjera_err;?></span><br> <br>
                <input type="submit" value="Registriraj se!">
            </form>

      
        </div>

        
        
    </body>




</html>