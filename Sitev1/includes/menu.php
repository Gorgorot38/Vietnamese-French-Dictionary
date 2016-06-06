<!-- En tête + Menu -->
<!DOCTYPE html>
        <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="style.css" />
        </head>
		<header class="accueil">
            <h1> Bienvenue / hoan nghênh</h1>
        </header>
        <header>
            <div id="Menu">
                <div id="Menu1">
                    <div class="element<?php if ($current == "main"){ echo ' selected"';} else  {echo '"';};?>><a href="Main.php" class="button" >Accueil<br />Hoan nghênh </a></div>
                    <div class="element<?php if ($current == "az"){ echo ' selected"';}else  {echo '"';}?>><a href="DicoAZ.php" class="button">Dictionnaire Alphabétique<br />Bảng chữ cái từ điển</a></div>
                    <div class="element<?php if ($current == "freq"){ echo ' selected"';}else{ echo '"';}?>><a href="DicoFreq.php" class="button">Dictionnaire Frequenciel<br />Tần số từ điển</a></div>
                </div>
                
                <div id="Menuleft">
                    <div id="MenuCo">
                        <div class="element<?php if ($current == "Co"){ echo ' selected"';}else{ echo '"';}?>><a href="Co.php" class="button">Connection</a></div>
                    </div>                    
                    <div id="Menuflag">
                        <div classe="flag fr" class="button"><img src="includes/pictures/fr.gif" alt="fr"><a href="#fr"></a></div>
                        <div classe="flag vi" class="button"><img src="includes/pictures/vi.gif" alt="vi"><a href="#vi"></a></div>
                    </div>
                </div>
            </div>
            
        </header>