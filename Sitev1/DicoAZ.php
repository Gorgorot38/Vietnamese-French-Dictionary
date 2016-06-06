<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
    </head>
    <body>
        <?php $current = "az"; include("includes/menu.php");  ?>
        <nav>
        	<ul>
                <li><a href="#">A</a></li>
            </ul>
        </nav>
        <?php
            // 1 : on ouvre le fichier
            //$monfichier = fopen('compteur.txt', 'r+');

            // 2 : on fera ici nos opérations sur le fichier...

            // 3 : quand on a fini de l'utiliser, on ferme le fichier
            //fclose($monfichier);
        ?>

        
        <?php include("includes/pied.php"); ?>
    </body>
</html>