<?php 
 ?>
<form action="bd.php?altertable='true'&mot=mot&Description=Description&Traduction=Traduction"  method="post">
    <div  id="base de données">
        <div>
            <h3>Entrée dans la base de données</h3>
        </div>


        <div>
            <label for="mot" class="label"  > Mot : </label>
           <label for="mot" class="label"  >  <?php echo $_POST["mot"]; ?> </label>
            <?php //echo $_POST["mot"]; ?> </br>
            <label for="Description" class="label"> Description </label>
            <textarea name="Description" id="Description" rows="5" cols="50"><?php if (isset($donnees)){echo $donnees["Description"];} ?>
            </textarea></br>
            <label for="Traduction" class="label"> Traduction : </label>
            <?php while ($donneestrad = $traduction->fetch()){
                    echo '<label for="Traduction" class="label">'.$donneestrad['mot'].'</label></br>';}

            ?>
            <label for="Traduction" class="label"> Nouvelle traduction </label>
            <input type="text" name="Traduction" class="champ" />
            </br>
            <input type="submit" value="Valider" />
    </form>
    </div>
