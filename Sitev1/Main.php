<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
    </head>
    <body>
        <?php $current = "main"; session_start(); include("includes/menu.php");  ?>
        <section class="Recherche">
            <h2>Chercher un mot / Tìm kiếm từ</h2>
            <form action="Main.php?search='mot'&pays=pays"  method="post">
                <input type="search" name ="mot"/>
            	<input type="submit" value="Rechercher" />
            	</br>
            	<select name="pays" id="pays">
                	<option value="fr">Français -> tiếng Việt</option>
                	<option value="vi">tiếng Việt -> Français</option>
           		</select>
           		</br>
           		<?php if(isset($_POST["mot"])&& isset($_POST["pays"])){ echo '<a href="Main.php" class="return">Nettoyer la recherche</a> </h3>';} ?>
            </form>
        </section>
        <?php if(isset($_POST["mot"])&& isset($_POST["pays"])){
        echo '<h3>Résultat de la recherche de "'. $_POST["mot"].'" ... </h3> <br />' ;
        include("includes/recherche.php");
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
                $reponse->closeCursor(); 
            }
       	}
            ?>
        <?php include("includes/pied.php"); ?>
    </body>
</html>