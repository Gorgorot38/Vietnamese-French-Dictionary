<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
    </head>
    <body>
        <?php $current = "bd"; session_start(); include("includes/menu.php"); $mot='';  ?>
        
        <?php  
                try{  
                    $bdd = new PDO('mysql:host=localhost;dbname=frenchvietnamesedictionnary;charset=utf8', 'root', ''); 
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                }                
                catch (Exception $e){
                     die('Erreur : ' . $e->getMessage());
                }
        // Modification du mot
        if(isset($_GET["altertable"])&& ($_GET["altertable"]== 'true')){

            if($_POST["pays"]=="fr"){
            $req = $bdd->query('SELECT idF from motfr where mot="'.$_POST["mot"].'"');
            $id = $req -> fetch();
            $idF = $id["idF"];            
            $req->closeCursor();
            if(!empty(trim($_POST["Description"]))){
                $Description = $_POST["Description"];
                $req = $bdd->prepare('INSERT INTO descriptionfr(idF,Description) VALUES(:idF,:Description)');
                $req->execute(array(
                    'idF' => $idF,
                    'Description' => $Description,
                    ));
                $req->closeCursor();
                echo '<p class=green> Nouvelle description prise en compte</p>';
            }
            else{
                echo '<p class=red> Pas de nouvelle description</p>';
            }
            $Traduction = $_POST['Traduction'];
            if(!empty(trim($_POST['Traduction']))){
                $req = $bdd->prepare('INSERT INTO motvi(FL,Freq,mot) VALUES(:FL,:Freq,:mot)');
                $req->execute(array(
                    'FL' => $Traduction[0],
                    'Freq' => 0,
                    'mot' => $Traduction 
                    ));
                echo '<p class=green>Nouvelle traduction pour '.$_POST["mot"].' : '.$_POST["Traduction"].'</p>';
                $req->closeCursor();

                $req = $bdd->query("SELECT idV from motvi where mot='$Traduction'");
                $id = $req -> fetch();
                $idV = $id["idV"];

                $req = $bdd->prepare('INSERT INTO traduction(idF,idV) VALUES(:idF,:idV)');
                $req->execute(array(
                    'idF' => $idF,
                    'idV' => $idV,
                    ));
                $req->closeCursor();
                echo '<p class=green> Nouvelle traduction prise en compte</p>';
            }
            else{
                echo '<p class=red> Pas de nouvelle traduction</p>';
            }
            }


            if($_POST["pays"]=="vi"){
            $req = $bdd->query('SELECT idV from motvi where mot="'.$_POST["mot"].'"');
            $id = $req -> fetch();
            $idV = $id["idV"];  
            $req->closeCursor();
            if(!empty(trim($_POST["Description"]))){
                $Description = $_POST["Description"];
                $req = $bdd->prepare('INSERT INTO descriptionvi(idV,Description) VALUES(:idV,:Description)');
                $req->execute(array(
                    'idV' => $idV,
                    'Description' => $Description,
                    ));
                $req->closeCursor();
               echo '<p class=green> Nouvelle description prise en compte</p>';
            }
            else{
                echo '<p class=red> Pas de nouvelle description</p>';
            }

            $Traduction = $_POST['Traduction'];
            if(!empty(trim($_POST["Traduction"]))){
                $req = $bdd->prepare('INSERT INTO motfr(FL,Freq,mot) VALUES(:FL,:Freq,:mot)');
                $req->execute(array(
                    'FL' => $Traduction[0],
                    'Freq' => 0,
                    'mot' => $Traduction 
                    ));
                echo '<p class=green>Nouvelle traduction pour '.$_POST["mot"].' : '.$_POST["Traduction"].'</p>';
                $req->closeCursor();

                $req = $bdd->query("SELECT idF from motfr where mot='$Traduction'");
                $id = $req -> fetch();
                $idF = $id["idF"];
                echo $idF;
                echo $idV;
                $req = $bdd->prepare('INSERT INTO traduction(idF,idV) VALUES(:idF,:idV)');
                $req->execute(array(
                    'idF' => $idF,
                    'idV' => $idV
                    ));
                $req->closeCursor();
           echo '<p class=green> Nouvelle traduction prise en compte</p>';
            }
            else{
                echo '<p class=red> Pas de nouvelle traduction</p>';
            }

        }
    }

        // Entrée d'un nouveau mot
        if(isset($_GET["altertable"])&& ($_GET["altertable"]== 'false')){
            $Traduction = $_POST['Traduction'];
            $mot = $_POST['mot'];

            if($_POST["pays"]=="fr"){
                $req3 = $bdd->query("SELECT mot from motfr where mot='$mot'");
                if(!($res = $req3 -> fetch())){
                $req = $bdd->prepare('INSERT INTO motfr(FL,Freq,mot) VALUES(:FL,:Freq,:mot)');
                $req->execute(array(
                        'FL' => $mot[0],
                        'Freq' => 0,
                        'mot' => $mot 
                        ));
                $req->closeCursor();
                echo '<p class=green> Un nouveau mot a été ajouté à la base de données</p>';
                $req = $bdd->query('SELECT idF from motfr where mot="'.$_POST["mot"].'"');
                $id = $req -> fetch();
                $idF = $id["idF"];            
                $req->closeCursor();
                $Description = $_POST["Description"];
                if(!empty(trim($_POST["Description"]))){
                    $req = $bdd->prepare('INSERT INTO descriptionfr(idF,Description) VALUES(:idF,:Description)');
                    $req->execute(array(
                        'idF' => $idF,
                        'Description' => $Description,
                        ));
                    $req->closeCursor();
                    echo "<p class=green> Un nouvelle Description a été ajouté au mot : ".$_POST["mot"]." !";
                }
               
                
                if(!empty(trim($_POST["Traduction"]))){
                    $req2 = $bdd->query("SELECT mot from motvi where mot='$Traduction'");
                        if(!($res = $req2 -> fetch())){
                            $req = $bdd->prepare('INSERT INTO motvi(FL,Freq,mot) VALUES(:FL,:Freq,:mot)');
                            $req->execute(array(
                                'FL' => $Traduction[0],
                                'Freq' => 0,
                                'mot' => $Traduction 
                                ));
                            echo '<p class=green>Nouvelle traduction pour '.$_POST["mot"].' : '.$_POST["Traduction"].'</p>';
                            $req->closeCursor();
                        }
                        else{
                            echo '<p class=green>Lien de traduction pour '.$_POST["mot"].' : '.$_POST["Traduction"].'</p>';
                        }
                        $req = $bdd->query("SELECT idF from motfr where mot='$mot'");
                        $id = $req -> fetch();
                        $idF = $id["idF"];
                        $req->closeCursor();
                        $req = $bdd->query("SELECT idV from motvi where mot='$Traduction'");
                        $id = $req -> fetch();
                        $idV = $id["idV"];
                        $req->closeCursor();
                        $req = $bdd->prepare('INSERT INTO traduction(idF,idV) VALUES(:idF,:idV)');
                        $req->execute(array(
                            'idF' => $idF,
                            'idV' => $idV
                         ));
                        
                    }
                }
                else{
                    echo '<p class=red> Le mot existe déjà </p>';
                }
            }
        


            if($_POST["pays"]=="vi"){
                $req3 = $bdd->query("SELECT mot from motvi where mot='$mot'");
                if(!($res = $req3 -> fetch())){
                    $req = $bdd->prepare('INSERT INTO motvi(FL,Freq,mot) VALUES(:FL,:Freq,:mot)');
                    $req->execute(array(
                            'FL' => $mot[0],
                            'Freq' => 0,
                            'mot' => $mot 
                            ));
                    $req->closeCursor();
                    echo '<p class=green> Un nouveau mot a été ajouté à la base de données</p>';
                    $req = $bdd->query('SELECT idV from motvi where mot="'.$_POST["mot"].'"');
                    $id = $req -> fetch();
                    $idV = $id["idV"];            
                    $req->closeCursor();
                    $Description = $_POST["Description"];
                    if(!empty(trim($_POST["Description"]))){
                        $req = $bdd->prepare('INSERT INTO descriptionv)');
                        $req->execute(array(
                            'idV' => $idV,
                            'Description' => $Description,
                        ));
                        $req->closeCursor();
                    echo "<p class=green> Un nouvelle Description a été ajouté au mot : ".$_POST["mot"]." !";
                }
                    
                    if(!empty(trim($_POST["Traduction"]))) {
                        $req2 = $bdd->query("SELECT mot from motfr where mot='$Traduction'");
                        if(!($res = $req2 -> fetch())){
                            $req = $bdd->prepare('INSERT INTO motfr(FL,Freq,mot) VALUES(:FL,:Freq,:mot)');
                            $req->execute(array(
                                'FL' => $Traduction[0],
                                'Freq' => 0,
                                'mot' => $Traduction 
                                ));
                            echo '<p class=green>Nouvelle traduction pour '.$_POST["mot"].' : '.$_POST["Traduction"].'</p>';
                            $req->closeCursor();
                        }
                        else{
                            echo '<p class=green>Lien de traduction pour '.$_POST["mot"].' : '.$_POST["Traduction"].'</p>';
                        }
                        $req = $bdd->query("SELECT idV from motvi where mot='$mot'");
                        $id = $req -> fetch();
                        $idV = $id["idV"];
                        $req->closeCursor();
                        $req = $bdd->query("SELECT idF from motfr where mot='$Traduction'");
                        $id = $req -> fetch();
                        $idF = $id["idF"];
                        $req->closeCursor();
                        $req = $bdd->prepare('INSERT INTO traduction(idF,idV) VALUES(:idF,:idV)');
                        $req->execute(array(
                            'idF' => $idF,
                            'idV' => $idV
                         ));
                    }
                }
                else{
                    echo '<p class=red> Le mot existe déjà </p>';
                }
            }

        }

        if (isset($_SESSION['idU']) && isset($_SESSION['pseudo'])){
            include("includes/formbd.php");
        }
        else{
        echo '       
        <p>
            Vous devez être connecté pour voir cette page!
        </p>';
    }
        ?>
        <?php include("includes/pied.php"); ?>
    </body>
</html>