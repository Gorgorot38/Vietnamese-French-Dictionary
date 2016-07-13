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
            bouton.innerHTML = 'Definitions (-)'; 
          } else { 
            div.style.display = "none"; 
            bouton.innerHTML = "Definitions (+)"; 
          }
        }
        </script>
        
    </head>
    <body>
        <?php $current = "main"; session_start(); include("includes/menu.php");  ?>
        <section class="Recherche">
            <h2>Chercher un mot / Tìm kiếm từ</h2>
            <form action="Main.php?search=mot&pays=pays"  method="post">
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
        //echo '<h3>Résultat de la recherche de "'. $_POST["mot"].'" ... </h3> <br />' ;
        include("includes/recherche.php");
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