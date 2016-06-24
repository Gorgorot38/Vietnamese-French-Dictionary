<section class="Traduction">
            <?php
                            
                    try{  
                        $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary;charset=utf8', 'root', '');
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }                
                    catch (Exception $e){
                        die('Erreur : ' . $e->getMessage());
                        
                    }   
                if($_POST['pays']=='fr'){
                    $reponse = $bdd->query('SELECT * FROM motfr WHERE mot="'.$_POST["mot"].'"');
                    $mot=$_POST["mot"];
                    $traduction = $bdd->query('SELECT DISTINCT mot FROM motvi JOIN traduction ON motvi.idV IN (SELECT idV FROM traduction JOIN motfr ON traduction.idF = (SELECT idF FROM motfr WHERE motfr.mot = "'.$_POST["mot"].'" ) )');                    
                }
                elseif ($_POST['pays']=='vi') {
                    $reponse = $bdd->query('SELECT * FROM motvi WHERE mot="'.$_POST["mot"].'"');  
                    $traduction = $bdd->query('SELECT DISTINCT mot FROM motfr JOIN traduction ON motfr.idF IN (SELECT idF FROM traduction JOIN motvi ON traduction.idV = (SELECT idV FROM motvi WHERE motvi.mot = "'.$_POST["mot"].'" ) )');
                }
                ?>
        </section>