<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
        
    </head>
    <body>
        <?php $current = "az"; session_start(); include("includes/menu.php");  ?>
        <section class="dico">
        
        <nav>
        <div class="btnlangue">
            <div class="btn">  
                <form action="DicoAZ.php?version=fr&letter=A"  method="post">
                    <input type="submit" <?php if($_GET['version']=='fr'){echo 'class="selected"';}?> value="Français" action="DicoAZ.php?version=fr&letter=A" />
                </form>

                <form action="DicoAZ.php?version=vi&letter=a"  method="post">
                    <input type="submit" <?php if($_GET['version']=='vi'){echo 'class="selected"';}?> value="Tiếng Việt" href="DicoAZ.php?version=vi&letter=a" />
                </form>
            </div>
        </div>
        <div class="btn">
        <nav>
            <div>
                <?php if($_GET['version']=='fr'){include("includes/alphabetfr.php");}elseif ($_GET['version']=='vi') {include("includes/alphabetvi.php");} else{include("includes/alphabetfr.php");}?>
            </div>
        </nav>
            <div class ="dicol">
            <?php  
                try{  
                    $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary;charset=utf8', 'root', '');  
                }                
                catch (Exception $e){
                     die('Erreur : ' . $e->getMessage());
                }
                if($_GET['version']=='fr'){
                    echo "</br>"."<h3>".$_GET["letter"]."</h3></br></br></br>";
                    $lettre = $_GET['letter'];
                    $reponse = $bdd->query('SELECT * FROM motFR where FL="'.$lettre.'"' ); 
                    while ($donnees = $reponse->fetch()){
                            echo "- ".$donnees['mot'] .' : <br />';
                            $description = $bdd->query('SELECT DISTINCT descriptionfr.Description FROM descriptionfr JOIN motfr ON descriptionfr.idF = (SELECT idF FROM motfr WHERE motfr.mot = "'.$donnees["mot"].'" ) ');
                             while ($donneesdesc = $description->fetch()){
                                echo "   ".$donneesdesc['Description'] .' : <br />';
                             }
                            
                    }             
                    $reponse->closeCursor(); 
                }
                elseif ($_GET['version']=='vi') {
                    echo "</br>"."<h3>".$_GET["letter"]."</h3></br></br></br>";
                    $lettre = $_GET['letter'];
                    $reponse = $bdd->query('SELECT * FROM motvi where FL="'.$lettre.'"' );  
                    while ($donnees = $reponse->fetch()){
                            echo "- ".$donnees['mot'] .' : <br />';
                            $description = $bdd->query('SELECT DISTINCT descriptionvi.Description FROM descriptionvi JOIN motvi ON descriptionvi.idV = (SELECT idV FROM motvi WHERE motvi.mot = "'.$donnees["mot"].'" ) ');
                            while ($donneesdesc = $description->fetch()){
                                echo "   ".$donneesdesc['Description'] .' : <br />';
                             }
                    }             
                    $reponse->closeCursor(); 
                
                }
            ?>
            </div>
            
        </div>
        
        </div>
        </section>
        <?php
            // <li><a href="#">A</a></li>
            // 1 : on ouvre le fichier
            //$monfichier = fopen('compteur.txt', 'r+');

            // 2 : on fera ici nos opérations sur le fichier...

            // 3 : quand on a fini de l'utiliser, on ferme le fichier
            //fclose($monfichier);
        ?>

        
        <?php include("includes/pied.php"); ?>
    </body>
</html>