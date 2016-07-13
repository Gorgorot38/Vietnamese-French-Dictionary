<div class = "rec">
                <div class = "btn0"> <h3><?php echo $_POST["mot"]; ?></h3>
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
                    echo $donneestrad['mot'].'<br />';
                    }
                ?>
                </div>
            </div>