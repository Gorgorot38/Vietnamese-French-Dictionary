
<form action="bd.php?altertable=true&mot=mot&Description=Description&Traduction=Traduction&pays=pays"  method="post">
    <div  id="base_de_données">
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
            <input type="radio" name="mot" value=<?php echo '"'.$_POST['mot'].'"'?> id=<?php echo '"'.$_POST['mot'].'"'?> checked="checked"/> <label for=<?php echo '"'.$_POST['mot'].'"'?>><?php echo " Mot : ".$_POST['mot'] ?></label> </br>

            <label for="Description" class="label"> Descriptions : </label>
            <label for="Description" class="label">
            <?php 
                while ($donneesdesc = $description->fetch()){
                    echo '<br /> - '. $donneesdesc["Description"];
                        }
             ?>
            </label>

            </br>

            <label for="Description" class="label"> Nouvelle Description </label>

            <textarea name="Description" id="Description" rows="5" cols="50"  charset=utf-8 > 
            </textarea></br>
            
            
            <?php

            echo '<label for="Traduction" class="label"> Traduction : </label>';

            while ($donneestrad = $traduction->fetch()){
                    echo '<label for="Traduction" class="label"> - '.$donneestrad['mot'].'</label></br>';}

            ?>
            <label for="Traduction" class="label"> Nouvelle traduction </label>
            <input type="text" name="Traduction" class="champ" />
            </br>
            <input type="submit" value="Valider" />
            </div>
    </form>
    </div>
