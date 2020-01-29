<?php
 

    session_start();    
    include_once 'db_connection.php';
    $conn = OpenConn();
    
    $id;
    $pretrazi = '';
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["izbrisi"])){
        $id = $_POST["id"];
        $sql = "SET FOREIGN_KEY_CHECKS=0";
        $conn->query($sql);
        $sql = "DELETE FROM `artikl` WHERE `artikl`.`artikl_id` = $id";
        $conn->query($sql);
        $sql = "SET FOREIGN_KEY_CHECKS=1";
        $conn->query($sql);
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pretraga"])){
        $pretrazi = $_POST["pretrazi"];
        
    }
    else if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if(!empty($_GET["artPage"])){
        $_SESSION["artPerPageAdmin"] = $_GET["artPage"];
        $_SESSION["artPerPage"] = $_SESSION["artPerPageAdmin"];
        }
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

        

        <div id="AdminPregled">
        <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik'] == "admin"){ ?>
        <h3>Pregled artikala: </h3> <br>
        <form action="adminPregled.php" method="GET">
        Broj artikala po stranici u pregledu kategorija: 
        <select name="artPage">
                    <?php
                        $num = $_SESSION["artPerPage"];
                    ?>
                    <option value="<?php echo $num;?>"><?php echo $num; ?></option>
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
        
            <input type="submit" class="Button2" value="Spremi odabir">
        </form>
        <form action="adminDodajArtikl.php" method="GET">
            <input type="submit" class="Button2" value="Dodaj artikal">
        </form>
        <form action="adminPregled.php" method="POST">
            Pretraži po nazivu artikla:
            <input type="text" class="ftekst" name="pretrazi"> 
            <input type="submit" class="Button2" name="pretraga" value="Pretraži">
        </form>
            <table id = "admintabla" border= 1>
                <tr>
                    <th>Naziv:</th>
                    <th>Cijena:</th>
                    <th>Popust:</th>
                    <th>Kategorija:</th>
                    <th>Slika:</th>
                    <th>Opis:</th>
                    <th>Uredi:</th>
                    <th>Izbrisi:</th>
                </tr>
        <?php
                    
            
            $sql = "SELECT * FROM `artikl`";
            $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        if($pretrazi == ""){
                            ?>
                        
                              
                            <tr>
                                <td><?php echo $row["artikl_naziv"]; ?></td>
                                <td><?php echo $row["artikl_cijena"]; ?></td>
                                <td><?php echo $row["popust"]; ?></td>
                                <td><?php echo $row["artikl_kategorija"]; ?></td>
                                <td><img class="image" src="<?php echo $row["slika"]; ?>"></td>
                                <td><?php echo $row["opis"]; ?></td>
                                <form action="adminUrediArtikl.php?" method="GET"> 
                                <td><input type="submit" class="Button2" name="uredi" value="Uredi"></td>
                                <input type="text" name="id" value="<?php echo $row["artikl_id"]; ?>" hidden>
                                </form>
                                <form action="adminPregled.php?" method="POST">  
                                    <input type="text" name="id" value="<?php echo $row["artikl_id"]; ?>" hidden>          
                                    <td><input type="submit" class="Button2" name="izbrisi" value="Izbrisi"></td>
                                </form>
                            </tr>
                            
                      
                        <?php
                        }
                       else if($pretrazi != "" && stristr($row["artikl_naziv"], $pretrazi)){
                        ?>
                        
                              
                        <tr>
                            <td><?php echo $row["artikl_naziv"]; ?></td>
                            <td><?php echo $row["artikl_cijena"]; ?></td>
                            <td><?php echo $row["popust"]; ?></td>
                            <td><?php echo $row["artikl_kategorija"]; ?></td>
                            <td><img src="<?php echo $row["slika"]; ?>"></td>
                            <td><?php echo $row["opis"]; ?></td>
                            <form action="adminUrediArtikl.php?" method="GET"> 
                            <td><input type="submit" name="uredi" value="Uredi"></td>
                            <input type="text" name="id" value="<?php echo $row["artikl_id"]; ?>" hidden>
                            </form>
                            <form action="adminPregled.php?" method="POST">  
                                <input type="text" name="id" value="<?php echo $row["artikl_id"]; ?>" hidden>          
                                <td><input type="submit" name="izbrisi" value="Izbrisi"></td>
                            </form>
                        </tr>
                        
                  
                    <?php
                        }
                    }    
                }     
                 
                    
                   
                closeCon($conn);
            
                ?>
                  </table>
                <?php
        }else{
            ?>
            <p>Niste ovlašteni pristupiti ovoj stranici</p>
            <?php
        }
                ?>
        </div>

    </div>
    </body>


</html>
