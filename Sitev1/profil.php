<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
    </head>
    <body>
        <?php $current = "profil"; session_start(); include("includes/menu.php");  ?>
        <?php 
            try{  
                        $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary;charset=utf8', 'root', '');
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }                
                    catch (Exception $e){
                        die('Erreur : ' . $e->getMessage());
                        
                    }
            $donnees = $bdd->query('SELECT * FROM users WHERE idU="'.$_SESSION["idU"].'"');
            $user = $donnees -> fetch();
            $count = $bdd->query('SELECT COUNT(*) as nb FROM avis WHERE idU="'.$_SESSION["idU"].'"');
            $nbavis = $count -> fetch();
        ?>
        <h3 class= "center"> Profil </h3>
        <div class="profil">
            <div class="img ligne">
                <div class="imguser">
                   <img src="includes/pictures/user.png" alt="user">
                </div>
            </div>
            <div class ="ligne">
            <div class="colonne">
                <div class = "enonce"> Nom </div>
                
                <div class = "enonce"> Rang </div>
                
                <div class = "enonce"> Adresse mail </div>
                
                <div class = "enonce"> Date d'inscription </div>
                
                <div class = "enonce"> Contributions </div>
            </div>
            <div class="colonne">
                <div class = "resultat"> <?php  echo $user["pseudo"]; ?></div>
                <div class = "resultat"> <?php  echo $user["rang"]; ?></div>
                <div class = "resultat"> <?php  echo $user["email"]; ?></div>
                <div class = "resultat"> <?php  echo $user["date_inscription"]; ?></div>
                <div class = "resultat"> <?php echo $nbavis["nb"] ;  ?> avis donnés </div>
            </div>
            </div>
        </div>
        </br>
    </body>
    <?php include("includes/pied.php"); ?>
</htjpeg