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
            <a class="navbar-brand" href="#">Minecraft Web Srv</a>
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
                <a class="version" href="https://github.com/nem-developing/">MW-SRV 1.0 - Nem-Developing</a>
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
            <p class="h1 breakshire" id="titrepage">Modification du serveur <?php echo"$nom"; ?></p>


            <!-- Formulaire de modification d'un serveur-->
            <form action="../actions/modifier.php" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nom du serveur</label>
                    <input class="form-control form-control-lg" type="text" name="namesrv" value="<?php echo"$nom"; ?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Nombre maximum de joueurs.</label>
                    <input type="number" class="form-control" name="count" min="1" max="7777777" name="joueursmax" value="<?php echo"$joueursmax"; ?>">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2"> Numéro du port pour JQuerry.</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo"$querryport"; ?>" disabled>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Vous n'avez pas accès à cette option. Elle n'est présente qu'à titre indicatif.
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Niveau de permitions des opérateurs (OP).</label>
                    <input type="number" class="form-control" name="count" min="1" max="4" name="opperms" value="<?php echo"$oppermissionlevel"; ?>">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Cette option détermine les autorisations pour les membres OP (Opérateurs) du serveur. 1 = Les membres OP peuvent passer outre les restrictions de protections du spawn du serveur. 2 = Les membres OP peuvent utiliser toutes les commandes de triche sur le serveur & utiliser des commandes blocs. 3 = Les membres OP peuvent utiliser les commandes d'administration (/ban ; /op ; etc). 4 = Les membres OP peuvent utiliser toutes les commandes disponibles sur le serveur ainsi que celles permetant de sauvegarder le serveur et de l'arrêter (/save-all ; /stop).
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">.</label>
                    <input type="number" class="form-control" name="count" min="1" max="4" name="opperms" value="<?php echo"$oppermissionlevel"; ?>">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Cette option détermine les autorisations pour les membres OP (Opérateurs) du serveur. 1 = Les membres OP peuvent passer outre les restrictions de protections du spawn du serveur. 2 = Les membres OP peuvent utiliser toutes les commandes de triche sur le serveur & utiliser des commandes blocs. 3 = Les membres OP peuvent utiliser les commandes d'administration (/ban ; /op ; etc). 4 = Les membres OP peuvent utiliser toutes les commandes disponibles sur le serveur ainsi que celles permetant de sauvegarder le serveur et de l'arrêter (/save-all ; /stop).
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Nether Autorisé</label>
                    <select class="form-control" id="exampleFormControlSelect1">
                        <?php echo ouiounon($allownether); ?>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary mb-2 boutonenvoie" value="ok">Modifier le serveur</button>
            </form>
        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </body>
</html>
