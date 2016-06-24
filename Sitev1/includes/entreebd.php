<?php 
 ?>
<form action="bd.php?altertable=false&mot=mot&Description=Description&Traduction=Traduction&pays=pays"  method="post">
    <div  id="base de données">
        <div>
            <h3>Entrée d'un nouveau mot dans la base de données</h3>
        </div>


        <div>

            <label for="mot" class="label"  > Mot : </label>
            <input type="text" name="mot" id="mot" required="required" placeholder=<?php echo '"'.$_POST["mot"].'"'; ?> size="30" maxlength="10" /></br>
            <?php
            if($_POST["pays"]=='fr'){ echo '
            <input type="radio" name="pays" value="fr" id="fr" checked="checked" /> <label for="fr">Français -> tiếng Việt</label></br>'; }

             if($_POST["pays"]=='vi'){ echo '
            <input type="radio" name="pays" value="vi" id="vi" checked="checked" /> <label for="vi">tiếng Việt -> Français</label> </br>';
            }
            ?>
            <label for="Description" class="label"> Description </label>
            <textarea name="Description" id="Description" rows="5" cols="50"><?php if (isset($donnees)){echo $donnees["Description"];} ?>
            </textarea></br>
            <label for="Traduction" class="label"> Traduction : </label>
            <input type="text" name="Traduction" class="champ" />
            </br>
            <input type="submit" value="Valider" />
    </form>
    </div>
