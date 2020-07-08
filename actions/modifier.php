<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>Modifier un serveur</title>
    </head>
    <body>
        <!-- Menu -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../index.php">Nix</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/Nem-developing/minecraft-web-srv/">Source code</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://github.com/Nem-developing/minecraft-web-srv/wiki">Documentation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">À propos</a>
                    </li>
                </ul>
                <a class="version" href="https://github.com/nem-developing/">Nix 1.0 - Nem-Developing</a>
            </div>
        </nav>  
         <! -- Titre de la page -->
        <div id="page">
            <p class="h1 breakshire" id="titrepage">Modification d'un serveur</p>


        <?php
        include "../config/config.php"; // Import des données de connexion.
        $id = $_POST['id'];          // On récupère les informations du formulaire précédent.
        $nom = $_POST['nom'];          // On récupère les informations du formulaire précédent.
        $joueursmax = $_POST['joueursmax'];          // On récupère les informations du formulaire précédent.
        $oppermissionlevel = $_POST['oppermissionlevel'];            // On récupère les informations du formulaire précédent.
        $allownether = $_POST['allownether'];            // On récupère les informations du formulaire précédent.
        $levelname = $_POST['levelname'];            // On récupère les informations du formulaire précédent.
        $allowflight = $_POST['allowflight'];            // On récupère les informations du formulaire précédent.
        $announceplayerachievements = $_POST['announceplayerachievements'];          // On récupère les informations du formulaire précédent.
        $leveltype = $_POST['leveltype'];            // On récupère les informations du formulaire précédent.
        $levelseed = $_POST['levelseed'];            // On récupère les informations du formulaire précédent.
        $forcegamemode = $_POST['forcegamemode'];            // On récupère les informations du formulaire précédent.
        $serverip = $_POST['serverip'];          // On récupère les informations du formulaire précédent.
        $maxbuildheight = $_POST['maxbuildheight'];          // On récupère les informations du formulaire précédent.
        $spawnnpcs = $_POST['spawnnpcs'];            // On récupère les informations du formulaire précédent.
        $whitelist = $_POST['whitelist'];            // On récupère les informations du formulaire précédent.
        $spawnanimals = $_POST['spawnanimals'];          // On récupère les informations du formulaire précédent.
        $hardcore = $_POST['hardcore'];          // On récupère les informations du formulaire précédent.
        $snooperenabled = $_POST['snooperenabled'];          // On récupère les informations du formulaire précédent.
        $onlinemode = $_POST['onlinemode'];          // On récupère les informations du formulaire précédent.
        $resourcepack = $_POST['resourcepack'];          // On récupère les informations du formulaire précédent.
        $pvp = $_POST['pvp'];            // On récupère; les informations du formulaire précédent.
        $difficulty = $_POST['difficulty'];          // On récupère les informations du formulaire précédent.
        $enablecommandblock = $_POST['enablecommandblock'];          // On récupère les informations du formulaire précédent.
        $gamemode = $_POST['gamemode'];          // On récupère les informations du formulaire précédent.
        $playeridletimeout = $_POST['playeridletimeout'];            // On récupère les informations du formulaire précédent.
        $spawnmonsters = $_POST['spawnmonsters'];            // On récupère les informations du formulaire précédent.
        $generatestructures = $_POST['generatestructures'];          // On récupère les informations du formulaire précédent.
        $viewdistance = $_POST['viewdistance'];          // On récupère les informations du formulaire précédent.
        $motd = $_POST['motd'];          // On récupère; les informations du formulaire précédent.
        
        
        // Vérifications de la récupérations des informations du formulaire précédent.
        echo "
        nom :$nom <br> 
        joueursmax :$joueursmax <br>
        oppermissionlevel :$oppermissionlevel <br>
        allownether :$allownether <br>
        levelname :$levelname <br>
        allowflight :$allowflight <br>
        announceplayerachievements :$announceplayerachievements <br>
        leveltype :$leveltype <br>
        levelseed :$levelseed <br>
        forcegamemode :$forcegamemode <br>
        serverip :$serverip <br>
        maxbuildheight :$maxbuildheight <br>
        spawnnpcs :$spawnnpcs <br>
        whitelist :$whitelist <br>
        spawnanimals :$spawnanimals <br>
        hardcore :$hardcore <br>
        snooperenabled :$snooperenabled <br>
        onlinemode :$onlinemode <br>
        resourcepack :$resourcepack <br>
        pvp :$pvp <br>
        difficulty :$difficulty <br>
        enablecommandblock :$enablecommandblock <br>
        gamemode :$gamemode <br>
        playeridletimeout :$playeridletimeout <br>
        spawnmonsters :$spawnmonsters <br>
        generatestructures :$generatestructures <br>
        viewdistance :$viewdistance <br>
        motd :$motd <br>";
        
        
        
        // Si un utilisateur tente d'accéder à cette page sans passer par les boutons adaptés, alors on va l'éjecter pour ne pas qu'il
        // y ait un soucis lors des requettes.
        if (!$_POST['id']){
            echo 'Erreur, vous de devez pas être là !';
            header('Location: ../index.php');   // redireciton vers la page d'acceuil.
            exit();
        }
        
        //  Test de connexion à la base de donnée.
        $mysqli = new mysqli("$hotedeconnexion", "$utilisateur", "$motdepasse", "$basededonnee");
        if ($mysqli->connect_errno) {
            echo "<div class='alert alert-danger' role='alert'> Echec lors de la connexion à MySQL ! </div>";   // Affichage de l'erreur.
            echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
            $erreur = $erreur + 1;
        }
        
        
        
        // Fonction "True or False" qui convertie les valeurs booléénes du formulaires en anglais.
        function ToF($variable) {
            if ($variable == "Oui") {
                echo "true";
            } else if($variable == "Non") {
                echo "false";
            } else {
                echo "Erreur !";
            }
            return;
        }
            
            
        ////////////////////////////////////////////////////////////////
        //  Envoie des différentes valeurs dans les bases de données  //
        ////////////////////////////////////////////////////////////////
        
        
        include "../config/config.php"; // Import des données de connexion.
        
        //  Connexion à la base de donnée.
        
        $mysqli = new mysqli("$hotedeconnexion", "$utilisateur", "$motdepasse", "$basededonnee");    
        
        // Commande SQL.
        $requette = "UPDATE `serveurs` SET `nom` = '$nom' WHERE `id` = '$id';";
        echo "$requette";
        
        
         // Changement du nom du serveur.
        if (!$mysqli->query("$requette")) { 
            echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
            $erreur = $erreur + 1;
        }
            
        
        // Commande SQL ajoutant les nouvelles options dans la base de donnée.
        $requette = "UPDATE `server.properties` SET `id` = '$id', `oppermissionlevel` = '$oppermissionlevel', `allownether` = '$allownether', `levelname` = '$levelname', `allowflight` = '$allowflight', `announceplayerachievements` = '$announceplayerachievements', `leveltype` = '$leveltype', `levelseed` = '$levelseed', `forcegamemode` = '$forcegamemode', `serverip` = '$serverip', `maxbuildheight` = '$maxbuildheight', `spawnnpcs` = '$spawnnpcs', `whitelist` = '$whitelist', `spawnanimals` = '$spawnanimals', `hardcore` = '$hardcore', `snooperenabled` = '$snooperenabled', `onlinemode` = '$onlinemode', `resourcepack` = '$resourcepack', `pvp` = '$pvp', `difficulty` = '$difficulty', `enablecommandblock` = '$enablecommandblock', `gamemode` = '$gamemode', `playeridletimeout` = '$playeridletimeout', `maxplayers` = '$joueursmax', `spawnmonsters` = '$spawnmonsters', `generatestructures` = '$generatestructures', `viewdistance` = '$viewdistance', `motd` = '$motd' WHERE `id` = '$id';";
        echo "$requette";
        
        
         // Envoie de cette commande dans mysql.
        if (!$mysqli->query("$requette")) { 
            echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
            $erreur = $erreur + 1;
        }
        
        ?>
        
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
