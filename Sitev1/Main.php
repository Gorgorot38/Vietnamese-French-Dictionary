<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />        
        <link rel="stylesheet" href="includes/tools/css/font-awesome.min.css">
        <script type="text/javascript">
            function toggle_div(bouton, id) { 
            var div = document.getElementById(id); 
            if(div.style.display=="none") { 
            div.style.display = "block"; 
            bouton.innerHTML = 'Definitions (-)'; 
          } else { 
            div.style.display = "none"; 
            bouton.innerHTML = "Definitions (+)"; 
          }
        }
        </script>       
        
    </head>
    <body>

        <?php
        try{  
                        $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary;charset=utf8', 'root', '');
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }                
                    catch (Exception $e){
                        die('Erreur : ' . $e->getMessage());
                        
                    }
         $current = "main"; session_start(); include("includes/menu.php");  ?>
        <?php  
        if (isset($_SESSION['idU']) && isset($_SESSION['pseudo']) && isset($_POST['value'])){
            
            $testused = $bdd->query('SELECT idA FROM avis WHERE idU="'.$_SESSION["idU"].'" AND idT="'.$_GET["trad"].'"');
            if(!($used = $testused ->fetch())) {
                if($_POST['value']=='+1'){
                    $req5 = $bdd->prepare('INSERT INTO avis(idT,idU,vote) VALUES(:idT,:idU,:vote)');
                    $req5 ->execute(array(
                        'idT' => $_GET["trad"],
                        'idU' => $_SESSION["idU"],
                        'vote' => "+1",
                             ));
                    $req5->closeCursor();
                    $req5 = $bdd->query('SELECT nbPV FROM traduction WHERE idT="'.$_GET["trad"].'"');
                    $PouceV = $req5 ->fetch();
                    $PV = $PouceV['nbPV'] + 1 ;
                    $req5->closeCursor();
                    $req6 = $bdd->prepare('UPDATE traduction SET nbPV = :nbPV WHERE traduction.idT = :idtrad');
                    $req6 ->execute(array(
                        'nbPV' => $PV,
                        'idtrad' => $_GET["trad"],
                             ));
                    $req6->closeCursor();
                }   

                if($_POST['value']=='-1'){
                    $req5 = $bdd->prepare('INSERT INTO avis(idT,idU,vote) VALUES(:idT,:idU,:vote)');
                    $req5 ->execute(array(
                        'idT' => $_GET["trad"],
                        'idU' => $_SESSION["idU"],
                        'vote' => "-1",
                             ));
                    $req5->closeCursor();
                    $req5 = $bdd->query('SELECT nbPR FROM traduction WHERE idT="'.$_GET["trad"].'"');
                    $PouceR = $req5 ->fetch();
                    $req4 = $bdd->query('SELECT nbPV FROM traduction WHERE idT="'.$_GET["trad"].'"');
                    $PouceV = $req4 ->fetch();
                    if(($PouceV['nbPV'] < ($PouceR['nbPR'] + 1)) && ($PouceV['nbPV']+$PouceR['nbPR']==5)){
                        $req6 = $bdd->query('DELETE FROM traduction WHERE traduction.idT = "'.$_GET["trad"].'"');
                        $req6->closeCursor();
                        $req5->closeCursor();
                        $req4->closeCursor();
                    }
                    else{
                        $PR = $PouceR['nbPR'] + 1 ;
                        $req5->closeCursor();
                        $req4->closeCursor();
                        $req6 = $bdd->prepare('UPDATE traduction SET nbPR = :nbPR WHERE traduction.idT = :idtrad');
                        $req6 ->execute(array(
                        'nbPR' => $PR,
                        'idtrad' => $_GET["trad"],
                             ));
                        $req6->closeCursor();   
                    }
                }
            }
        }

    ?>
        <section class="Recherche">
            <h2>Chercher un mot / Tìm kiếm từ</h2>
            <form action="Main.php?search=mot&pays=pays"  method="get">
                <input type="search" name ="mot"/>
            	<input type="submit" value="Rechercher" />
            	</br>
            	<select name="pays" id="pays">
                	<option value="fr">Français -> tiếng Việt</option>
                	<option value="vi">tiếng Việt -> Français</option>
           		</select>
           		</br>
           		<?php if(isset($_GET["mot"])&& isset($_GET["pays"])){ echo '<a href="Main.php" class="return">Nettoyer la recherche</a> </h3>';} ?>
            </form>
        </section>
        <?php if(isset($_GET["mot"])&& isset($_GET["pays"])){
        //echo '<h3>Résultat de la recherche de "'. $_POST["mot"].'" ... </h3> <br />' ;
        include("includes/recherchemain.php");

        if($donnees = $reponse->fetch()){
            include("includes/like.php");
        }
        else{
            echo '<p class ="red"> Le mot n\'est pas enregistré dans le dictionnaire </p> <p> Voulez vous l\'ajouter?    <a href="bd.php" class="green" >Oui</a>   <a href="Main.php" class="red">Non</a> </p>' ;
        }       
                
            
            $reponse->closeCursor(); 
        }

            ?>
            
            </br>
            </body>
        
        <?php include("includes/pied.php"); ?>
    </body>
</html>