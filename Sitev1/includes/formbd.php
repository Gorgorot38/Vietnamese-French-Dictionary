<form action="bd.php?search=mot&pays=pays"  method="post">
    <div  id="base_de_données">
        <div>
            <h3>Recherche dans la base de données</h3>
        </div>
        <div>
            <input type="search" name ="mot"/>
            <input type="submit" value="Rechercher" />
            </br>
            <select name="pays" name="new" id="pays">

                <option value="fr">Français -> tiếng Việt</option>
                <option value="vi">tiếng Việt -> Français</option>
            </select>
            </br>
        </div>
    </form>
    </div>

<?php
    if(isset($_POST["mot"])&& isset($_POST["pays"])){
        include("includes/recherche.php");
        if(isset($_GET["altertable"])){
        }
        else{
            if (!($donnees = $reponse->fetch())){
                echo "<p class='red'>Le Mot n'existe pas !</p>";
                include("entreebd.php");           
            }
            else{
                include("alterbd.php");
            }
        }
    }
 ?>