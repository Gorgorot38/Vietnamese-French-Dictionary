<form action="inscri.php?pseudo=pseudo&mdp=mdp&email=email"  method="post">
        <div  id="inscription">
            <div>
                <h3>Formulaire d'inscription</h3>
            </div>
            <div>
                <label for="pseudo" class="label"> Pseudo </label>
            </div>
            <div>
                <input type="text" name="pseudo" class="champ"  required="required" />
                <?php if($pseudoutilisé==false){echo '<em class="red"> pseudo déjà utilisé ou incorrect </em>';} ?>
                </br>
            </div>
            <div>      
                <label for="mdp" class="label"> Mot de passe </label>
            </div>
            <div>
                <input type="password" name="mdp" class="champ"  required="required" /></br>
            </div>
            <div>            
                <label for="mdpbis" class="label"> Retapez votre mot de passe </label>
            </div>
            <div>
                <input type="password" name="mdpbis" class="champ"  required="required" />
                <?php if($mdputilisé==false){echo '<em class="red"> les mots de passe ne sont pas identiques </em>';} ?></br>
            </div>
            <div>            
                <label for="email" class="label"> Email </label>
            </div>
            <div>
                <input type="text" name="email" class="champ"  required="required"/>
                <?php if($emailvalide==false){echo '<em class="red"> email non valide </em>';}
                 elseif($emailutilisé==false){echo '<em class="red"> email déjà utilisé </em>';} ?></br>
            </div>
            <div>
                <label for="captcha">Recopiez le mot : ""</label>
            </div>
            <div>
                <input type="text" name="captcha" id="captcha" required="required"/><br />
            </div>
            <div>               
                <input type="submit" value="Valider" />
            </div>
        </form>
        </div>
        <p class='registered'>
        <?php if(($count2 == 0) && ($count == 0) && ($mdp == $mdpbis) && (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) ){ echo 'Félicitation, vous êtes maintenant inscris au site!';} ?>
        </p>