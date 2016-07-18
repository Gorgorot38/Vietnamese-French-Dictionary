<section class="Traduction">
            <?php  
                if($_GET['pays']=='fr'){
                    $reponse = $bdd->query('SELECT * FROM motfr WHERE mot="'.$_GET["mot"].'"');
                    $traduction = $bdd->query('SELECT DISTINCT motvi.idV,mot FROM motvi JOIN traduction ON motvi.idV IN (SELECT idV FROM traduction JOIN motfr ON traduction.idF = (SELECT idF FROM motfr WHERE motfr.mot = "'.$_GET["mot"].'" ) )');
                    $description = $bdd->query('SELECT DISTINCT descriptionfr.Description FROM descriptionfr JOIN motfr ON descriptionfr.idF = (SELECT idF FROM motfr WHERE motfr.mot = "'.$_GET["mot"].'" ) ');
                }
                elseif ($_GET['pays']=='vi') {
                    $reponse = $bdd->query('SELECT * FROM motvi WHERE mot="'.$_GET["mot"].'"');  
                    $traduction = $bdd->query('SELECT DISTINCT motfr.idF,mot FROM motfr JOIN traduction ON motfr.idF IN (SELECT idF FROM traduction JOIN motvi ON traduction.idV = (SELECT idV FROM motvi WHERE motvi.mot = "'.$_GET["mot"].'" ) )');
                    $description = $bdd->query('SELECT DISTINCT descriptionvi.Description FROM descriptionvi JOIN motvi ON descriptionvi.idV = (SELECT idV FROM motvi WHERE motvi.mot = "'.$_GET["mot"].'" ) ');

                }
                ?>
        </section>