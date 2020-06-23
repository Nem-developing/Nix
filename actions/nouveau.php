<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="css/nouveau.css" rel="stylesheet" type="text/css"/>
        <title>Création d'un nouveau serveur !</title>
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



    <center>
        <div id="page">            


            <?php
            include "../config/config.php"; // Import des données de connexion.
            date_default_timezone_set('UTC');   // On informe mysql de la zone temporelle souhaitée.
            $namesrv = $_POST['namesrv'];       // On récupère les informations du formulaire précédent.
            $version = $_POST['version'];       // On récupère les informations du formulaire précédent.
            $date = strftime("%d/%m/%y");       // On entre la date dans la variable $date.
            $ip = $_SERVER['REMOTE_ADDR'];      // On récupère l'addresse IP du client. | Note : Cette IP est stoqué sur la base de donné client uniquement.
            $joueursmax = $_POST['joueursmax'];
            
            (int) $erreur = 0;
            
            if (!$ip) {
                $ip = "0.0.0.0";    // Si l'utilisateur utilise un proxy ; La fonction Remote addr peut dysfonctionner ; C'est une mesure de sécurité.
            }

            //  Connexion à la base de donnée.
            $mysqli = new mysqli("$hotedeconnexion", "$utilisateur", "$motdepasse", "$basededonnee");
            if ($mysqli->connect_errno) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de la connexion à MySQL ! </div>";   // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }
            // Création de la table où l'on stoque les informations de créations de serveurs.
            // Nous notons que le champ "Actif" permet de trier les serveur actifs (=0) de ceux qui sont supprimés(=1)
            if (!$mysqli->query("CREATE TABLE IF NOT EXISTS `serveurs` ( `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `nom` varchar(21) NOT NULL, `version` varchar(7) NOT NULL,`joueursmax` INT NOT NULL, `datecreation` varchar(10) NOT NULL, `ipcrea` varchar(19) NOT NULL,  `actif` int(1) NOT NULL );")) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de la création de la table serveurs ! </div>";    // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }

            // On ajoute les informations du formulaire dans la table "serveurs".
            if (!$mysqli->query("INSERT INTO `serveurs` (`nom`, `version`, `joueursmax`, `datecreation`, `ipcrea`, `actif`) VALUES ('$namesrv', '$version' ,'$joueursmax' ,'$date', '$ip', '0');")) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de l'ajout de vos données dans de la table ! </div>";    // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }

            // Création de la table où l'on stoque les informations réseau du serveur (Port ; Jquerry ; Rcon)
            if (!$mysqli->query("CREATE TABLE IF NOT EXISTS `ports` ( `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `port` varchar(5) NOT NULL, `jquerry` varchar(5) NOT NULL, `rcon` varchar(5) NOT NULL, `rconmdp` varchar(15) NOT NULL);")) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de la création de la table ports ! </div>";    // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }
            
                        
            // $dernierid = 0 quand il n'y a aucunes valeurs ; Il sera égale à l'id du dernier champ de la table serveur.
            (int) $dernierid = 0;
            
            
             if (!$mysqli->query('SELECT * FROM `serveurs`;')) {
                $dernierid = 0;
            } else {
                // Établissement de la connexion au serveur mysql.
                $cnx = new PDO("mysql:host=$hotedeconnexion;dbname=$basededonnee", "$utilisateur", "$motdepasse");
                // Commande SQL permetant de récupérer la liste des serveurs.
                $req = 'SELECT * FROM `serveurs`;';
                // Envoie au serveur la commande via le biais des informations de connexion.
                $res = $cnx->query($req);

                // Boucle tant qu'il y a de lignes corespondantes à la requettes
                while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
                    (int) $dernierid = $ligne->id;
                }
            }
            
            
            
            // Atribution des données.

            $dernierid = $dernierid - 1;
            
            $port = (25565 + $dernierid);   // Port de jeu

            $querry = (35565 + $dernierid); // Port JQuerry

            $rcon = (45565 + $dernierid);   // Port Rcon 

            $pass = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 1, 20); // Génération d'un mot de passe aléatoire.

            $idserveur = $dernierid + 1;    // Identifiant actuel.

                        
            if (!$mysqli->query("INSERT INTO `ports` (`port`, `jquerry`, `rcon`, `rconmdp`) VALUES ('$port', '$querry', '$rcon', '$pass');")) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de l'ajout de vos données dans de la table ! </div>";    // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }



            /////////////////////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////////////
            //SERVEUR MINECRAFT - SERVEUR MINECRAFT - SERVEUR MINECRAFT - SERVEUR MINECRAFT - SERVEUR MINECRAFT//
            /////////////////////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////////////


            $liendownload = "";

            // Établissement des liens de téléchargements en fonction de la version du serveur.
            switch ($version) {
                case "1.7.10":
                    $liendownload = "https://launcher.mojang.com/v1/objects/952438ac4e01b4d115c5fc38f891710c4941df29/server.jar";
                    break;
                case "1.8":
                    $liendownload = "https://launcher.mojang.com/v1/objects/a028f00e678ee5c6aef0e29656dca091b5df11c7/server.jar";
                    break;
                case "1.9":
                    $liendownload = "https://launcher.mojang.com/v1/objects/b4d449cf2918e0f3bd8aa18954b916a4d1880f0d/server.jar";
                    break;
                case "1.10":
                    $liendownload = "https://launcher.mojang.com/v1/objects/a96617ffdf5dabbb718ab11a9a68e50545fc5bee/server.jar";
                    break;
                case "1.11":
                    $liendownload = "https://launcher.mojang.com/v1/objects/48820c84cb1ed502cb5b2fe23b8153d5e4fa61c0/server.jar";
                    break;
                case "1.12":
                    $liendownload = "https://launcher.mojang.com/v1/objects/8494e844e911ea0d63878f64da9dcc21f53a3463/server.jar";
                    break;
                case "1.13":
                    $liendownload = "https://launcher.mojang.com/v1/objects/d0caafb8438ebd206f99930cfaecfa6c9a13dca0/server.jar";
                    break;
                case "1.14":
                    $liendownload = "https://launcher.mojang.com/v1/objects/f1a0073671057f01aa843443fef34330281333ce/server.jar";
                    break;
                case "1.15":
                    $liendownload = "https://launcher.mojang.com/v1/objects/e9f105b3c5c7e85c7b445249a93362a22f62442d/server.jar";
                    break;
                case "1.15.2":
                    $liendownload = "https://launcher.mojang.com/v1/objects/bb2b6b1aefcd70dfd1892149ac3a215f6c636b07/server.jar";
                    break;
                
            }
            // Changement de répertoire.
            chdir("/home/mwsrv-user/");
            
            // Création d'un dossier corespondant à l'id du serveur.
            mkdir("$idserveur", 0700);
            
            // Téléchargement du fichier server.jar.
            $s = shell_exec("cd /home/mwsrv-user/$idserveur ;wget $liendownload");
            echo "$s";

            // Premier lancement du serveurs.
            shell_exec("cd /home/mwsrv-user/$idserveur ; java -jar server.jar");
            
            // Activation du EULA.
            $s = shell_exec("cd /home/mwsrv-user/$idserveur ; sed -i 's/false/true/g' eula.txt");
            echo "$s";

            // Création du fichier de lancement du serveur.
            $s = shell_exec("cd /home/mwsrv-user/$idserveur ; echo 'java $commandedelancement -jar server.jar nogui' > start.sh");
            echo "$s";

            // Création de l'insertion du serveur dans un Screen.
      		$s = shell_exec("cd /home/mwsrv-user/$idserveur ; echo 'screen -AmdS serveur_$idserveur ./start.sh' > start_avec_screen.sh");
            echo "$s";

            // Définition des deux fichier de lancement comme des fichier éxecutables. 
            $s = shell_exec("cd /home/mwsrv-user/$idserveur ; chmod +x start.sh ; chmod +x start_avec_screen.sh ");
            echo "$s";
            
            
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //  PROPRIÉTÉS DU SERVEUR - PROPRIÉTÉS DU SERVEUR - PROPRIÉTÉS DU SERVEUR - PROPRIÉTÉS DU SERVEUR - PROPRIÉTÉS DU SERVEUR //
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            
            // Création de la table où l'on stoque les propriétés du serveur.
            if (!$mysqli->query("CREATE TABLE IF NOT EXISTS `server.properties` (`id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `query.port` int NOT NULL,`op-permission-level` int NOT NULL,`allow-nether` varchar(5) NOT NULL,`level-name` varchar(20) NOT NULL,`enable-query` varchar(5) NOT NULL,`allow-flight` varchar(5) NOT NULL,`announce-player-achievements` varchar(5) NOT NULL,`server-port` int NOT NULL,`level-type` varchar(15) NOT NULL,`enable-rcon` varchar(5) NOT NULL,`level-seed` varchar(32) NOT NULL,`force-gamemode` varchar(5) NOT NULL,`server-ip` int NOT NULL,`max-build-height` int NOT NULL,`spawn-npcs` varchar(5) NOT NULL,`white-list` varchar(5) NOT NULL,`rcon.password` varchar(30) NOT NULL,`spawn-animals` varchar(5) NOT NULL,`hardcore` varchar(5) NOT NULL,`snooper-enabled` varchar(5) NOT NULL,`online-mode` varchar(5) NOT NULL,`resource-pack` varchar(30) NOT NULL,`pvp` varchar(5) NOT NULL,`difficulty` int NOT NULL,`enable-command-block` varchar(5) NOT NULL,`gamemode` int NOT NULL,`player-idle-timeout` int NOT NULL,`max-players` int NOT NULL,`rcon.port` int NOT NULL,`spawn-monsters` varchar(5) NOT NULL,`generate-structures` varchar(5) NOT NULL,`view-distance` int NOT NULL,`motd` varchar(25) NOT NULL);")) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de la création de la table server.properties ! </div>";    // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }
            
            // Ajout des options par défaut.
            if (!$mysqli->query("INSERT INTO `server.properties` (`query.port`, `op-permission-level`, `allow-nether`, `level-name`, `enable-query`, `allow-flight`, `announce-player-achievements`, `server-port`, `level-type`, `enable-rcon`, `level-seed`, `force-gamemode`, `server-ip`, `max-build-height`, `spawn-npcs`, `white-list`, `rcon.password`, `spawn-animals`, `hardcore`, `snooper-enabled`, `online-mode`, `resource-pack`, `pvp`, `difficulty`, `enable-command-block`, `gamemode`, `player-idle-timeout`, `max-players`, `rcon.port`, `spawn-monsters`, `generate-structures`, `view-distance`, `motd`) VALUES ('$querry', '4', 'true', 'world', 'true', 'false', 'true', '$port', 'default', 'true', '', 'false', '', '256', 'true', 'false', '$pass', 'true', 'false', 'true', 'true', '', 'true', '1', 'false', '0', '0', '$joueursmax', ' $rcon', 'true', 'true', '10', 'Un serveur Minecraft !');")) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de l'ajout des options par défaut dans la table server.properties ! </div>";    // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }
            
            
            
            
            
            if ($erreur === 0) {    // test de la présence d'erreurs ou non.
                echo "pas d'erreurs";
                header('Location: ../index.php');
                exit();
            } else {
                echo "<h1>Il semble y avoir une erreur, veuillez vous référer à l'alerte au dessus !</h1>";
            }
            ?>



        </div>
    </center>















    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>
