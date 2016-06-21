<html>
    <head>
        <!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />

        <script language="javascript"> 
        function goUrl(selectUrl) {
            url=selectUrl.options[selectUrl.SelectedIndex].value ;
            getElementById('tonForm').action=url ;
            getElementById('tonForm').submit() ;
        }
        </script>

    </head>
    <body>
        <?php $current = "main"; include("includes/menu.php");  ?>
        <section class="Recherche">
            <h2>Chercher un mot / Tìm kiếm từ</h2>
             <form action="search.php?search=mot&version=fr"  method="post">
                 <input type="search" name ="mot"/>
                 <input type="submit" value="Rechercher" />
                 <label for="langue"> Français -> tiếng Việt </label>
            </form>
            <form action="search.php?search='mot'&version=vi"  method="post">
                 <input type="search" name ="mot"/>
                 <input type="submit" value="Tìm kiếm" />
                 <label for="langue"> tiếng Việt -> Français </label>
            </form>
        </section>
        <section class="Traduction">
            <h3>Résultat de la recherche de "<?php echo $_POST["mot"]; ?>" ... <br /> <a href="Main.php" class="return">Nettoyer la recherche</a> </h3>
            <?php
                            
                    try{  
                        $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary;charset=utf8', 'root', '');  
                    }                
                    catch (Exception $e){
                        die('Erreur : ' . $e->getMessage());                }   
                if($_GET['version']=='fr'){
                    $reponse = $bdd->query('SELECT * FROM motfr WHERE mot="'.$_POST["mot"].'"');  
                    $traduction = $bdd->query('SELECT mot FROM simplevi WHERE idV=(SELECT idV FROM tradsimple WHERE idF = (SELECT idF FROM motFR WHERE mot="'.$_POST["mot"].'"))');
                    if ($donnees = $reponse->fetch()){
                        if($donnees['mot'] == $_POST["mot"]){
                            echo "mot : ".$donnees['mot'].'<br />';
                            echo "1ère lettre : ".$donnees['FL'].'<br />';
                            echo "Frequence : ".$donnees['Freq'].'<br />';    
                            echo "Description : ".$donnees['Description'].'<br />';
                             while ($donneestrad = $traduction->fetch()){
                            echo "Traduction : ".$donneestrad['mot'].'<br />';
                            }
                        }   

                    }             
                    $reponse->closeCursor(); 
                }
                elseif ($_GET['version']=='vi') {
                    $reponse = $bdd->query('SELECT * FROM simplevi WHERE mot="'.$_POST["mot"].'"');  
                    $traduction = $bdd->query('SELECT mot FROM motfr WHERE idF=(SELECT idF FROM tradsimple WHERE idV = (SELECT idV FROM simplevi WHERE mot="'.$_POST["mot"].'"))');
                    if ($donnees = $reponse->fetch()){
                        if($donnees['mot'] == $_POST["mot"]){
                            echo "mot : ".$donnees['mot'].'<br />';
                            echo "1ère lettre : ".$donnees['FL'].'<br />';
                            echo "Frequence : ".$donnees['Freq'].'<br />';    
                            echo "Description : ".$donnees['Description'].'<br />';
                             while ($donneestrad = $traduction->fetch()){
                            echo "Traduction : ".$donneestrad['mot'].'<br />';
                            }
                        }   

                    }             
                    $reponse->closeCursor(); 
                }
                ?>
        </section>
        

        <?php include("includes/pied.php"); ?>
    </body>
</html>