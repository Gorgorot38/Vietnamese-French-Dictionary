<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
        <script type="text/javascript">
            function toggle_div(bouton, id) { 
            var div = document.getElementById(id); 
            if(div.style.display=="none") { 
            div.style.display = "block"; 
            bouton.innerHTML = '(-)'; 
          } else { 
            div.style.display = "none"; 
            bouton.innerHTML = "(+)"; 
          }
        }
        </script>
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
                    echo "<div class=titreAZ>"."<h2>".$_GET["letter"]."</h2></div>";

                    echo "<div class='dicoAZ'>";
                    
                    $lettre = $_GET['letter'];
                    $reponse = $bdd->query('SELECT * FROM motFR where FL="'.$lettre.'" ORDER BY mot '  ); 
                    echo "<div class='dicolettre'>";
                    echo "<div class='dicolettremot'> Mot </div>";
                    echo "<div class='dicolettredesc'> Description(s) </div>";
                    echo "<div class='dicolettretrad'> Traduction(s) </div>";
                    echo "</div>";
                    while ($donnees = $reponse->fetch()){
                            echo "<div class='dicolettre'>";
                            echo "<div class='dicolettremot'>".$donnees['mot'] .'</div>';
                            $description = $bdd->query('SELECT DISTINCT descriptionfr.Description FROM descriptionfr JOIN motfr ON descriptionfr.idF = (SELECT idF FROM motfr WHERE motfr.mot = "'.$donnees["mot"].'" ) ');
                             echo "<div class='dicolettredesc'>";
                             while ($donneesdesc = $description->fetch()){
                                echo $donneesdesc['Description']."</br>";
                             } 
                             echo "</div>";
                             
                            $traduction = $bdd->query('SELECT DISTINCT motvi.idV,mot FROM motvi JOIN traduction ON motvi.idV IN (SELECT idV FROM traduction JOIN motfr ON traduction.idF = (SELECT idF FROM motfr WHERE motfr.mot = "'.$donnees["mot"].'" ) )');
                            echo "<div class='dicolettretrad'>";
                             while ($donneestrad = $traduction->fetch()){
                                echo $donneestrad['mot']."</br>";
                             } 
                             echo "</div>";
                             echo "</div>";
                             //include("includes/dbtn.php");
                    }             
                    $reponse->closeCursor(); 
                }
                elseif ($_GET['version']=='vi') {
                    echo "<div class=titreAZ>"."<h2>".$_GET["letter"]."</h2></div>";

                    echo "<div class='dicoAZ'>";
                    
                    $lettre = $_GET['letter'];
                    $reponse = $bdd->query('SELECT * FROM motvi where FL="'.$lettre.'" ORDER BY mot '  ); 
                    echo "<div class='dicolettre'>";
                    echo "<div class='dicolettremot'> Mot </div>";
                    echo "<div class='dicolettredesc'> Description(s) </div>";
                    echo "<div class='dicolettretrad'> Traduction(s) </div>";
                    echo "</div>";
                    while ($donnees = $reponse->fetch()){
                            echo "<div class='dicolettre'>";
                            echo "<div class='dicolettremot'>".$donnees['mot'] .'</div>';
                            $description = $bdd->query('SELECT DISTINCT descriptionvi.Description FROM descriptionvi JOIN motvi ON descriptionvi.idV = (SELECT idV FROM motvi WHERE motvi.mot = "'.$donnees["mot"].'" ) ');
                             echo "<div class='dicolettredesc'>";
                             while ($donneesdesc = $description->fetch()){
                                echo $donneesdesc['Description']."</br>";
                             } 
                             echo "</div>";
                             
                            $traduction = $bdd->query('SELECT DISTINCT motfr.idF,mot FROM motfr JOIN traduction ON motfr.idF IN (SELECT idF FROM traduction JOIN motvi ON traduction.idV = (SELECT idV FROM motvi WHERE motvi.mot = "'.$donnees["mot"].'" ) )');
                            echo "<div class='dicolettretrad'>";
                             while ($donneestrad = $traduction->fetch()){
                                echo $donneestrad['mot']."</br>";
                             } 
                             echo "</div>";
                             echo "</div>";
                             //include("includes/dbtn.php");
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