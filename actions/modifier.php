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
        
        
        // On défini la valeur par défaut de la varialbe d'erreurs
        $erreur = 0;
        
        // Fonction "True ou False" qui convertie les valeurs booléénes du formulaires en anglais.
        function ToF($variable) {
            if ($variable == "Oui") {
                return "true";
            } else if($variable == "Non") {
                return "false";
            } else {
                return "Erreur !";
            }
            return;
        }
        
        
        
        // Changement des valeurs françaises vers anglaises.
        // On transforme nos variable initiale en variable modifiées (Reconnaissable en "$mavariableOK")
        
        
        $allownetherOK = ToF($allownether);
        $allowflightOK = ToF($allowflight);
        $announceplayerachievementsOK = ToF($announceplayerachievements);
        $forcegamemodeOK = ToF($forcegamemode);
        $spawnnpcsOK = ToF($spawnnpcs);
        $whitelistOK = ToF($whitelist);
        $spawnanimalsOK = ToF($spawnanimals);
        $hardcoreOK = ToF($hardcore);
        $snooperenabledOK = ToF($snooperenabled);
        $onlinemodeOK = ToF($onlinemode);
        $pvpOK = ToF($pvp);
        $enablecommandblockOK = ToF($enablecommandblock);
        $spawnmonstersOK = ToF($spawnmonsters);
        $generatestructuresOK = ToF($generatestructures);
        
        
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
            
            
        ////////////////////////////////////////////////////////////////
        //  Envoie des différentes valeurs dans les bases de données  //
        ////////////////////////////////////////////////////////////////
        
        
        include "../config/config.php"; // Import des données de connexion.
        
        //  Connexion à la base de donnée.
        
        $mysqli = new mysqli("$hotedeconnexion", "$utilisateur", "$motdepasse", "$basededonnee");    
        
        // Commande SQL permmetant la modifiaction de la table "SEVEURS".
        $requette = "UPDATE `serveurs` SET `nom` = '$nom', `joueursmax` = '$joueursmax' WHERE `id` = '$id';";
        
        // Envoie de cette commande dans mysql.
        
        if (!$mysqli->query("$requette")) { 
            echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
            $erreur = $erreur + 1;
        }
            
        
        // Commande SQL ajoutant les nouvelles options dans la base de donnée.
        $requette = "UPDATE `server.properties` SET `id` = '$id', `oppermissionlevel` = '$oppermissionlevel', `allownether` = '$allownetherOK', `levelname` = '$levelname', `allowflight` = '$allowflightOK', `announceplayerachievements` = '$announceplayerachievementsOK', `leveltype` = '$leveltype', `levelseed` = '$levelseed', `forcegamemode` = '$forcegamemodeOK', `serverip` = '$serverip', `maxbuildheight` = '$maxbuildheight', `spawnnpcs` = '$spawnnpcsOK', `whitelist` = '$whitelistOK', `spawnanimals` = '$spawnanimalsOK', `hardcore` = '$hardcoreOK', `snooperenabled` = '$snooperenabledOK', `onlinemode` = '$onlinemodeOK', `resourcepack` = '$resourcepack', `pvp` = '$pvpOK', `difficulty` = '$difficulty', `enablecommandblock` = '$enablecommandblockOK', `gamemode` = '$gamemode', `playeridletimeout` = '$playeridletimeout', `maxplayers` = '$joueursmax', `spawnmonsters` = '$spawnmonstersOK', `generatestructures` = '$generatestructuresOK', `viewdistance` = '$viewdistance', `motd` = '$motd' WHERE `id` = '$id';";
        
        
         // Envoie de cette commande dans mysql.
        if (!$mysqli->query("$requette")) { 
            echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
            $erreur = $erreur + 1;
        }
        
        
        // Nous changeons seulement le fichier server.properties si et seulement si il n'y a toujours pas d'érreur.
        if ($erreur === 0){


            // On récupe quelques informations dans la base de donnée. //
            
        
            // Établissement de la connexion au serveur mysql.
            $cnx = new PDO("mysql:host=$hotedeconnexion;dbname=$basededonnee", "$utilisateur", "$motdepasse");
            // Commande SQL permetant de récupérer la liste des serveurs actifs.
            $req = 'SELECT * FROM `server.properties` where id = "' . $id . '"';
            // Envoie au serveur la commande via le biais des informations de connexion.
            $res = $cnx->query($req);

            
            
            // Boucle tant qu'il y a de lignes corespondantes à la requettes
            while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
                $serverport = $ligne->serverport;
                $querryport = $ligne->queryport;
                $rconport = $ligne->rconport;
                $rconpass = $ligne->rconpassword;
            }
            
            // Suppression de l'ancien fichier
            shell_exec("cd /home/nix-user/$id ; rm server.properties");
            
            // Ajout des paramètres dans server.properties. 
            shell_exec("cd /home/nix-user/$id ; echo op-permission-level=$oppermissionlevel > server.properties");
            shell_exec("cd /home/nix-user/$id ; echo allow-nether=$allownetherOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo level-name=$levelname >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo enable-query=true >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo allow-flight=$allowflightOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo announce-player-achievements=$announceplayerachievementsOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo rcon.password=$rconpass >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo server-port=$serverport >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo query.port=$querryport >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo level-type=$leveltype >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo enable-rcon=true  >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo level-seed=$levelseed >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo force-gamemode=$forcegamemodeOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo server-ip=$serverip >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo max-build-height=$maxbuildheight >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo spawn-npcs=$spawnnpcsOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo white-list=$whitelistOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo spawn-animals=$spawnanimalsOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo hardcore=$hardcoreOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo snooper-enabled=$snooperenabledOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo online-mode=$onlinemodeOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo resource-pack=$resourcepack >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo pvp=$pvpOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo difficulty=$difficulty >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo enable-command-block=$enablecommandblockOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo gamemode=$gamemode >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo player-idle-timeout=$playeridletimeout >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo max-players=$joueursmax >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo rcon.port=$rconport >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo spawn-monsters=$spawnmonstersOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo view-distance=$viewdistance >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo generate-structures=$generatestructuresOK >> server.properties");
            shell_exec("cd /home/nix-user/$id ; echo motd=$motd >> server.properties");

            
            
            
        }
        
        
        
        
        
        
        
        
        if ($erreur === 0) {    // test de la présence d'erreurs ou non.
                header('Location: ../index.php');   // On redirige automatiquement vers la page d'accueil si il n'y a pas d'erreur
                exit();
            } else {    // Sinon on affiche qu'il y a une erreur et là, on reste sur la page.
                echo "<h1>Il semble y avoir une erreur, veuillez vous référer à l'alerte au dessus !</h1>";
            }
       
        ?>
        
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
