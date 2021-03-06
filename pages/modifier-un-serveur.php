<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title>Modifier un serveur - Nix</title>
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

        <?php
        // Récupération des infomrations du serveur.

        include "../config/config.php"; // Import des données de connexion.
        $id = $_GET['id'];

        // Si un utilisateur tente d'accéder à cette page sans passer par les boutons adaptés, alors on va l'éjecter pour ne pas qu'il
        // y ait un soucis lors des requettes.
        if (!$_GET['id']) {
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


        // Récupération des informations du serveur dans les tables de données.
        // Établissement de la connexion au serveur mysql.
        $cnx = new PDO("mysql:host=$hotedeconnexion;dbname=$basededonnee", "$utilisateur", "$motdepasse");
        // Commande SQL permetant de récupérer la liste des informations du serveur.
        $req = 'SELECT * FROM serveurs where id = "' . $id . '"';
        // Envoie au serveur la commande via le biais des informations de connexion.
        $res = $cnx->query($req);

        // Boucle tant qu'il y a de lignes corespondantes à la requettes donc seulement une.
        while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
            $nom = $ligne->nom;
        }
        $req = 'SELECT * FROM `server.properties` where id = "' . $id . '"';
        // Envoie au serveur la commande via le biais des informations de connexion.
        $res = $cnx->query($req);

        // Boucle tant qu'il y a de lignes corespondantes à la requettes donc seulement une.
        // Définition des données variables selon les différents serveurs.
        while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
            $querryport = $ligne->queryport;
            $joueursmax = $ligne->maxplayers;
            $oppermissionlevel = $ligne->oppermissionlevel;
            $allownether = $ligne->allownether;
            $levelname = $ligne->levelname;
            $allowflight = $ligne->levelname;
            $announceplayerachievements = $ligne->levelname;
            $leveltype = $ligne->leveltype;
            $levelseed = $ligne->levelseed;
            $forcegamemode = $ligne->forcegamemode;
            $serverip = $ligne->serverip;
            $maxbuildheight = $ligne->maxbuildheight;
            $spawnnpcs = $ligne->spawnnpcs;
            $whitelist = $ligne->whitelist;
            $spawnanimals = $ligne->spawnanimals;
            $hardcore = $ligne->hardcore;
            $snooperenabled = $ligne->snooperenabled;
            $onlinemode = $ligne->onlinemode;
            $resourcepack = $ligne->resourcepack;
            $pvp = $ligne->pvp;
            $difficulty = $ligne->difficulty;
            $enablecommandblock = $ligne->enablecommandblock;
            $gamemode = $ligne->gamemode;
            $playeridletimeout = $ligne->playeridletimeout;
            $maxplayers = $ligne->maxplayers;
            $rconport = $ligne->rconport;
            $spawnmonsters = $ligne->spawnmonsters;
            $generatestructures = $ligne->generatestructures;
            $viewdistance = $ligne->viewdistance;
            $motd = $ligne->motd;
        }

        // Fonction affichant l'option sauvegardé précédement. (+ Cela simplifie le code ^^)
        function ouiounon($variable) {
            if ($variable == "true") {
                echo "
                    <option selected>Oui</option>
                    <option>Non</option>
                    ";
            } else {
                echo "
                    <option>Oui</option>
                    <option selected>Non</option>
                    ";
            }
            return;
        }
        ?>

        <! -- Titre de la page -->
        <div id="page">
            <center>
                <p class="h1 breakshire" id="titrepage">Modification du serveur <?php echo"$nom"; ?></p>


                <!-- Formulaire de modification d'un serveur-->
                <form action="../actions/modifier.php" method="post">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nom du serveur</label>
                        <input class="form-control form-control-lg" type="text" name="nom" value="<?php echo"$nom"; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Identifiant interne</label>
                        <input type="number" class="form-control" min="<?php echo"$id"; ?>" max="<?php echo"$id"; ?>" name="id" value="<?php echo"$id"; ?>">
                        <small class="form-text text-muted">
                            L'identifiant interne de serveur est un numéro vous permettant de retrouver vos fichiers de serveurs au sein de votre machine.
                        </small>
                    </div>                                       
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Nombre maximum de joueurs</label>
                        <input type="number" class="form-control" min="1" max="7777777" name="joueursmax" value="<?php echo"$joueursmax"; ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2"> Numéro du port pour JQuerry</label>
                        <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo"$querryport"; ?>" disabled>
                        <small class="form-text text-muted">
                            Vous n'avez pas accès à cette option. Elle n'est présente qu'à titre indicatif.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Niveau de permitions des opérateurs (OP).</label>
                        <input type="number" class="form-control" min="1" max="4" name="oppermissionlevel" value="<?php echo"$oppermissionlevel"; ?>">
                        <small class="form-text text-muted">
                            Cette option détermine les autorisations pour les membres OP (Opérateurs) du serveur. 1 = Les membres OP peuvent passer outre les restrictions de protections du spawn du serveur. 2 = Les membres OP peuvent utiliser toutes les commandes de triche sur le serveur & utiliser des commandes blocs. 3 = Les membres OP peuvent utiliser les commandes d'administration (/ban ; /op ; etc). 4 = Les membres OP peuvent utiliser toutes les commandes disponibles sur le serveur ainsi que celles permetant de sauvegarder le serveur et de l'arrêter (/save-all ; /stop).
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nether Autorisé</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="allownether">
                            <?php echo ouiounon($allownether); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Nom de la carte du monde.</label>
                        <input class="form-control form-control-lg" type="text" name="levelname" value="<?php echo"$levelname"; ?>" required>
                        <small class="form-text text-muted">
                            Atention, si vous modifiez cette option, la carte sera régénérée !!
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Vol Autorisé (Fly)</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="allowflight">
                            <?php echo ouiounon($allowflight); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Diffusion des succès (Achivements)</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="announceplayerachievements">
                            <?php echo ouiounon($announceplayerachievements); ?>
                        </select>
                        <small class="form-text text-muted">
                            Cette option diffuse un message dans le tchat anoncant la réalisation d'un succès par l'un des joueurs sur le serveur.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Type de carte</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="leveltype">
                            <?php
                            switch ($leveltype) {
                                case "default": {
                                        echo "
                                        <option selected>default</option>
                                        <option>flat</option>
                                        <option>largeBiomes</option>
                                        <option>amplified</option>
                                        ";
                                        break;
                                    }
                                case "flat": {
                                        echo "
                                        <option>default</option>
                                        <option selected>flat</option
                                        <option>largeBiomes</option>
                                        <option>amplified</option>
                                        ";
                                        break;
                                    }
                                case "largeBiomes": {
                                        echo "
                                        <option>default</option>
                                        <option>flat</option>
                                        <option selected>largeBiomes</option>
                                        <option>amplified</option>
                                        ";
                                        break;
                                    }
                                case "amplified": {
                                        echo "
                                        <option>default</option>
                                        <option>flat</option>
                                        <option>largeBiomes</option>
                                        <option selected>amplified</option>
                                        ";
                                        break;
                                    }
                            }
                            ?>
                        </select>
                        <small class="form-text text-muted">
                            Cette option change le type de carte de jeu. Default = Monde "Normal". Flat = Monde plat. LargeBiomes = Les biomes sont plus grand. Amplified = Exactement comme par défaut mais la hauteur du monde est plus élevlée.
                        </small>
                    </div>  
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">SEED de la carte</label>
                        <input type="number" class="form-control" name="levelseed" min="0" max="18446744073709551616" value="<?php echo"$levelseed"; ?>">
                        <small class="form-text text-muted">
                            Cette option te prermetra de gérer la façon dont est créée ta map ! Attention, vous avez besoin de recréer une map pour que vos modifications ici soient priées en compte dans le jeu.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Forcer le mode de jeu (Force Game Mode)</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="forcegamemode">
                            <?php echo ouiounon($forcegamemode); ?>
                        </select>
                        <small class="form-text text-muted">
                            Le serveur forcera dès l'arrivée des joueurs dans le serveur, à être dans le gamodème défini par l'option "Game Mode".  
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Mode de jeu (Game Mode)</label>
                        <input type="number" class="form-control" name="gamemode" min="0" max="3" value="<?php echo"$gamemode"; ?>">
                        <small class="form-text text-muted">
                            Cette option définit le mode de jeu que le serveur utilisera si vous activez l'option force gamemode. Attention, si vous n'avez pas activé le force gamemode, vous ne verrez aucun changement.g
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">IP du serveur</label>
                        <input class="form-control form-control-lg" type="text" name="serverip" value="<?php echo"$serverip"; ?>">
                        <small class="form-text text-muted">
                            Cette option vous permez de définir l'adresse IP de votre serveur. Il est consseilé de laisser ce champ vide.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Hauteur de construction maximale</label>
                        <input type="number" class="form-control" name="maxbuildheight" min="0" max="99999999999" value="<?php echo"$maxbuildheight"; ?>">
                        <small class="form-text text-muted">
                            Hauteur maximale de construction.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Vilageois activés</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="spawnnpcs">
                            <?php echo ouiounon($spawnnpcs); ?>
                        </select>
                        <small class="form-text text-muted">
                            Si désactivé, vous ne pourrez plus voir de vilageois.  
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Liste blanche (White List)</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="whitelist">
                            <?php echo ouiounon($whitelist); ?>
                        </select>
                        <small class="form-text text-muted">
                            Si activés, vous devrez autoriser des joueurs à entrer sur le serveur pour que tel soit le cas.  
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Animaux activés</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="spawnanimals">
                            <?php echo ouiounon($spawnanimals); ?>
                        </select>
                        <small class="form-text text-muted">
                            Si désactivé, aucun animal n'apparaîtras.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Mode Hardcore activé</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="hardcore">
                            <?php echo ouiounon($hardcore); ?>
                        </select>
                        <small class="form-text text-muted">
                            Si activé, aucune régénération classique (Barre nouriture pleine) n'apparaitra.
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Mode indiscret activé (Snooper)</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="snooperenabled">
                            <?php echo ouiounon($snooperenabled); ?>
                        </select>
                        <small class="form-text text-muted">
                            Si activé, le serveur envera les spécificités de la machine d'où il est stoqué (Nottament : Système d'exploitation, Version de java, etc.).
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Joueurs "Légaux" seulement ?</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="onlinemode">
                            <?php echo ouiounon($onlinemode); ?>
                        </select>
                        <small class="form-text text-muted">
                            Si désactivé, votre serveur acceptera les versions CRACK.  
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">PVP Activé ?</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="pvp">
                            <?php echo ouiounon($pvp); ?>
                        </select>
                        <small class="form-text text-muted">
                            Si désactivé, aucun joueur ne pourra en taper un autre (Désolé...).  
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Commands blocks</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="enablecommandblock">
                            <?php echo ouiounon($enablecommandblock); ?>
                        </select>
                        <small class="form-text text-muted">
                            Il faut activer cette option pour pouvoir utiliser les commands blocs.  
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Difficulté de jeu</label>
                        <input type="number" class="form-control" name="difficulty" min="0" max="3" value="<?php echo"$difficulty"; ?>">
                        <small class="form-text text-muted">
                            Cette option définit la difficulté de jeu sur le serveur. 0 : Paisible. 1 : Facile. 2 : Normale. 3 : Difficile.                     
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Temps d'inactivité autorisé</label>
                        <input type="number" class="form-control" name="playeridletimeout" min="0" max="777" value="<?php echo"$playeridletimeout"; ?>">
                        <small class="form-text text-muted">
                            Cette option définit le temps (en minute) d'inactivités autorisées. Note : 0 désactive simplement l'option.        
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Monstres Activés</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="spawnmonsters">
                            <?php echo ouiounon($spawnmonsters); ?>
                        </select>
                        <small class="form-text text-muted">
                            Si désactivé, aucun monstre n'apparaîtra.  
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Structures Activées</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="generatestructures">
                            <?php echo ouiounon($generatestructures); ?>
                        </select>
                        <small class="form-text text-muted">
                             Si désactivé, aucune structure n'apparaîtra (Villages, Stronghold, etc.). 
                        </small>
                    </div>                                       
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Distance d'affichage</label>
                        <input type="number" class="form-control" name="viewdistance" min="3" max="15" value="<?php echo"$viewdistance"; ?>">
                        <small class="form-text text-muted">
                            Nombre de chunks ENVOYEES par le serveur. Important : cette valeur ne doit être utilisée qu'en cas de lags importants elle sera donc réduite.  
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">MOTD</label>
                        <input class="form-control form-control-lg" type="text" value="<?php echo"$motd"; ?>" name="motd" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 boutonenvoie" value="ok">Sauvegarder</button>
                </form>
            </center>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
