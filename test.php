if(isset($_GET["cart"])){
                        $cart = $_GET["cart"];
                        $postoji = false;
                        if(!isset($_SESSION['kosarica'])){
                            $_SESSION['kosarica'] = array();
                            $_SESSION['numArt'] = ;

                            array_push($_SESSION['kosarica'], $cart);
                            array_push($_SESSION['numArt'], '1');
                        }else{
                            for($i = 0; $i < count($_SESSION['kosarica']); $i++){
                                if($_SESSION['kosarica'][$i] == $cart){
                                    $_SESSION['numArt'][$i] += 1;
                                    $postoji = true;
                                }
                            }
                            if(!$postoji){
                                array_push($_SESSION['kosarica'], $cart);
                                array_push($_SESSION['numArt'], '1');
                            }
                        }
                            
                    }