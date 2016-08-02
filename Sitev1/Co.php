<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
    </head>
    <body>
        <?php $current = "Co"; 
        session_start();
        if(isset($_GET['deco'])){
            $_SESSION = array();
            session_destroy();  

            // Suppression des cookies de connexion automatique
            setcookie('pseudo', '');
            setcookie('idU', ''); }
        include("includes/menu.php");
        ?>


        <?php 
        try{  
            $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));  
        }                
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        if(isset($_POST['pseudo'])&& isset($_POST['mdp'])) {
            $pseudo = addslashes(htmlspecialchars(htmlentities(trim($_POST['pseudo']))));
            $mdp = sha1($_POST['mdp']);

            // Vérification des identifiants
            $req = $bdd->prepare('SELECT idU FROM users WHERE pseudo = :pseudo AND pass = :mdp');
            $req->execute(array(
                'pseudo' => $pseudo,
                'mdp' => $mdp));            

            $resultat = $req->fetch();          

            if (!$resultat)
            {
                echo 'Mauvais identifiant ou mot de passe !';
            }
            else
            {
                $_SESSION['idU'] = $resultat['idU'];
                $_SESSION['pseudo'] = $pseudo;
                echo 'Vous êtes connecté '. $_SESSION['pseudo'] .' !';
            }
            if((isset($_POST['co']))){
                setcookie('pseudo', $_POST['pseudo'], time() + 100*24*3600, null, null, false, true) ;
                setcookie('idU', $resultat['idU'], time() + 100*24*3600, null, null, false, true) ;
            }
        }
        ?>
        
        <form action="Co.php?pseudo=pseudo&mdp=mdp&co=co"  method="post">
        <div  id="connection">
            <div>
                <h3>Connection</h3>
            </div>
            <div id ="connect">
                <label for="pseudo" class="label"> Pseudo </label>
                <input type="text" name="pseudo" class="champ" /></br>
                <label for="mdp" class="label"> Mot de passe </label>
                <input type="password" name="mdp" class="champ" /></br>
                <label for="auto" class="auto"> Rester connecté </label>
                <input type="checkbox" name="co" for='co' value='co'  /></br>
                <input type="submit" value="Se connecter" />

            </div>
        </form>
        
                <p><a href="inscri.php">Je ne suis pas inscrit !</a><br/>
            </p>
        </div>
        
        <?php include("includes/pied.php"); ?>
    </body>
</html>