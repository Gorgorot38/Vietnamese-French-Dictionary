<div class = "rec">
                <div class = "btn0"> <?php echo $_GET["mot"]; ?>
                </div>
                <div class = "btn1">
                <button class="main_btn" classtype="button" onclick="toggle_div(this,'id_du_div');">Definitions (+)</button>
                </div>
                <div id="id_du_div" class="btn2" style="display:none;">
                <?php
                	if(!($donneesdesc = $description->fetch())){
                    	echo '<p class="red"> Aucune définition trouvée</p>';
                    	echo '<a href="bd.php" class="return">Rajouter une définition</a>';
                    }
                    	echo $donneesdesc['Description']."</br>"; 
                	while ($donneesdesc = $description->fetch()){
                    	echo $donneesdesc['Description']."</br>";
                    }

                ?>
                </div>
                <div class = "btn1">
                Traductions
                </div>
                <div class='btn2'>
                <?php
                while ($donneestrad = $traduction->fetch()){
                	if($_GET['pays']=='fr'){
                		$donneesvote = $bdd->query('SELECT idT,traduction.nbPR,traduction.nbPV FROM traduction WHERE traduction.idF="'.$donnees["idF"].'" AND traduction.idV="'.$donneestrad["idV"].'"  ');
                	}
                	elseif($_GET['pays']=='vi'){ 
                		$donneesvote = $bdd->query('SELECT idT,traduction.nbPR,traduction.nbPV FROM traduction WHERE traduction.idV="'.$donnees["idV"].'" AND traduction.idF="'.$donneestrad["idF"].'"  ');
                	}
                	$PVPR = $donneesvote -> fetch();           	
                	echo ' <div class="btn3">';
                    echo ' <div class="votemot"> - '.$donneestrad['mot'].'</div>';
                    include("includes/vote.php");
                    echo '</div>';
                    }
                ?>
                </div>
            </div>