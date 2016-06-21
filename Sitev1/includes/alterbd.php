
<form action="bd.php?altertable=true&mot=mot&Description=Description&Traduction=Traduction&pays=pays"  method="post">
    <div  id="base de données">
        <div>
            <h3>Entrée dans la base de données</h3>
        </div>


        <div>
            <?php
            if($_POST["pays"]=='fr'){ echo '
            <input type="radio" name="pays" value="fr" id="fr" checked="checked" /> <label for="fr">Français -> tiếng Việt</label></br>'; }

             if($_POST["pays"]=='vi'){ echo '
            <input type="radio" name="pays" value="vi" id="vi" checked="checked" /> <label for="vi">tiếng Việt -> Français</label> </br>';
            }
            ?>
            <input type="radio" name="mot" value="mot" id="mot" checked="checked"/> <label for="mot"><?php echo " Mot : ".$_POST['mot'] ?></label> </br>

            
            <label for="Description" class="label"> Description </label>
            <textarea name="Description" id="Description" rows="5" cols="50"><?php if (isset($donnees)){echo $donnees["Description"];} ?>
            </textarea></br>
            <label for="Traduction" class="label"> Traduction : </label>
            <?php while ($donneestrad = $traduction->fetch()){
                    echo '<label for="Traduction" class="label"> - '.$donneestrad['mot'].'</label></br>';}

            ?>
            <label for="Traduction" class="label"> Nouvelle traduction </label>
            <input type="text" name="Traduction" class="champ" />
            </br>
            <input type="submit" value="Valider" />
    </form>
    </div>
