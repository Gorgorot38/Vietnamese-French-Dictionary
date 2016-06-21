<section class="Traduction">
            <?php
                            
                    try{  
                        $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary;charset=utf8', 'root', '');  
                    }                
                    catch (Exception $e){
                        die('Erreur : ' . $e->getMessage());                }   
                if($_POST['pays']=='fr'){
                    $reponse = $bdd->query('SELECT * FROM motfr WHERE mot="'.$_POST["mot"].'"');  
                    $traduction = $bdd->query('SELECT mot FROM motvi WHERE idV=(SELECT idV FROM traduction WHERE idF = (SELECT idF FROM motFR WHERE mot="'.$_POST["mot"].'"))');
                    
                }
                elseif ($_POST['pays']=='vi') {
                    $reponse = $bdd->query('SELECT * FROM motvi WHERE mot="'.$_POST["mot"].'"');  
                    $traduction = $bdd->query('SELECT mot FROM motfr WHERE idF=(SELECT idF FROM traduction WHERE idV = (SELECT idV FROM motvi WHERE mot="'.$_POST["mot"].'"))');
                }
                ?>
        </section>