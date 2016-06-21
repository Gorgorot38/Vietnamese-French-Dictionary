<form action="bd.php?search=mot&pays=pays"  method="post">
    <div  id="base de données">
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
        </div>
    </form>
    </div>

<?php
    if(isset($_POST["mot"])&& isset($_POST["pays"])){
        include("includes/recherche.php");
        if (!($donnees = $reponse->fetch())){
            echo "Le Mot n'existe pas !";
            include("entreebd.php");           
        }
        else{
            include("alterbd.php");
        }
    }
 ?>