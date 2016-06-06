<html>
    <head>
    	<!-- 1er test -->
        <meta charset="utf-8" />
        <title>Dictionnaire Francais/tiếng Việt</title>
        <link rel="stylesheet" href="includes/style.css" />
    </head>
    <body>
        <?php $current = "main"; include("includes/menu.php");  ?>
        <section class="Recherche">
            <h2>Chercher un mot / Tìm kiếm từ</h2>
            <form action="search.php"  method="post">
                <p>
                 <input type="search" name ="mot"/>
                 <input type="submit" value="Rechercher/Tìm kiếm" /><br />
                 <label for="langue"> Choix de langue / Ngôn ngữ </label><br />
                 <select name="langue" id="langue">
                    <option value="Français -> tiếng Việt">Français -> Tiếng Việt</option>
                    <option value="tiếng Việt -> Français">Tiếng Việt -> Français</option>
                 </select>
                 </p>
            </form>
            <br />
        </section>
        <section class="Traduction">
            <h3>Résultat de la recherche de "<?php echo $_POST['mot']; ?>" ... <br /> <a href="Main.php" class="return">Nettoyer la recherche</a> </h3>
             
        </section>
        

        <?php include("includes/pied.php"); ?>
    </body>
</html>