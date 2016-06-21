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
                }                
                catch (Exception $e){
                     die('Erreur : ' . $e->getMessage());
                }
        if(isset($_GET["altertable"])&& ($_GET["altertable"]== true)){
            if($_POST["pays"]=="fr"){
            $mot = addslashes(htmlspecialchars(htmlentities(trim($_POST['mot']))));
            echo $mot;
            $bdd->query("SELECT idF from motfr where mot='$mot'");
            
            //$bdd->exec("UPDATE motfr SET Description = $_ WHERE motfr.idF = 1");
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