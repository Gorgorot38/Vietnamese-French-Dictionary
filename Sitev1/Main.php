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
            <form action="search.php?search='mot'&version=fr"  method="post">
                 <input type="search" name ="mot"/>
                 <input type="submit" value="Rechercher" />
                 <label for="langue"> Français -> tiếng Việt </label>
            </form>
            <form action="search.php?search='mot'&version=vi"  method="post">
                 <input type="search" name ="mot"/>
                 <input type="submit" value="Tìm kiếm" />
                 <label for="langue"> Tiếng Việt -> Français </label>
            </form>
            <br />
        </section>
        <?php include("includes/pied.php"); ?>
    </body>
</html>