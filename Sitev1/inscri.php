<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
    </head>
    <body>
        <?php $current = "inscri"; session_start(); include("includes/menu.php");  ?>

        <?php
            $emailvalide = true; $emailutilisé = true;$mdputilisé=true; $pseudoutilisé=true; $mdp=''; $mdpbis='';$email='';
            try{  
                $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));  
                }                
            catch (Exception $e){
                die('Erreur : ' . $e->getMessage());
                }            
            $count= 0;
            $count2=0;

            if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['mdpbis'])) {//vérification de la bonne rentrée des données
                $pseudo = addslashes(htmlspecialchars(htmlentities(trim($_POST['pseudo']))));
                $email = addslashes(htmlspecialchars(htmlentities(trim($_POST['email']))));
                $mdp = sha1($_POST['mdp']);
                $mdpbis = sha1($_POST['mdpbis']);
                //$testpseudo = $bdd->query('SELECT * FROM users WHERE pseudo='.$_POST["pseudo"].'))');

                //$donnees = $testpseudo->fetch();
                if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){
                    if($mdp == $mdpbis){
                        $req = $bdd->query("SELECT pseudo FROM users WHERE pseudo = '$pseudo'"); // On séléectionne le champ (identifiant) dans notre table users où identifiant est égale au champ identifiant rentré par l'utilisateur
                        $count = $req->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
                            if($count == 0){      
                                $req2 = $bdd->query("SELECT email FROM users WHERE email = '$email'");
                                $count2 = $req2->rowCount();
                                if($count2 == 0){

                                $req = $bdd->prepare('INSERT INTO users(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
                                $req->execute(array('pseudo' => $_POST['pseudo'],'pass' => $mdp,'email' => $_POST['email']));
                            }
                        }
                    }
                }
                if($count2 != 0){$emailutilisé = false;}
                if($count != 0){$pseudoutilisé=false;}
                if($mdp != $mdpbis){$mdputilisé=false;}
                if(!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)){$emailvalide = false;}
            }
        ?>
        <?php
            if (isset($_SESSION['idU']) AND isset($_SESSION['pseudo'])){
                echo 'Bonjour ' . $_SESSION['pseudo'];
            }
            else{
                include("includes/forminscri.php");
            }
            include("includes/pied.php"); 
        ?>
    </body>
</html>