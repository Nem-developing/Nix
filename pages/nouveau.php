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
            (int) $erreur = 0;

            //  Connexion à la base de donnée.
            $mysqli = new mysqli("$hotedeconnexion", "$utilisateur", "$motdepasse", "$basededonnee");
            if ($mysqli->connect_errno) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de la connexion à MySQL ! </div>";   // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }
            // Création de la table où l'on stoque les informations de créations de serveurs.
            // Nous notons que le champ "Actif" permet de trier les serveur actifs (=0) de ceux qui sont supprimés(=1)
            if (!$mysqli->query("CREATE TABLE IF NOT EXISTS `serveurs` ( `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT, `nom` varchar(21) NOT NULL, `version` varchar(7) NOT NULL, `datecreation` varchar(10) NOT NULL, `actif` int(1) NOT NULL );")) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de la création de la table serveurs ! </div>";    // Affichage de l'erreur.
                echo "<div class='alert alert-danger' role='alert'> Erreur N°$mysqli->errno : $mysqli->error.</div>";    // Affichage de l'erreur.
                $erreur = $erreur + 1;
            }

            // On ajoute les informations du formulaire dans la table "serveurs".
            if (!$mysqli->query("INSERT INTO `serveurs` (`nom`, `version` , `datecreation`, `actif`) VALUES ('$namesrv', '$version', '$date', '0');")) {
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
            
            
             if (!$mysqli->query('SELECT * FROM `serveurs` where `actif` = "0";')) {
                $dernierid = 0;
            } else {
                // Établissement de la connexion au serveur mysql.
                $cnx = new PDO("mysql:host=$hotedeconnexion;dbname=$basededonnee", "$utilisateur", "$motdepasse");
                // Commande SQL permetant de récupérer la liste des serveurs actifs.
                $req = 'SELECT * FROM `serveurs` where `actif` = "0";';
                // Envoie au serveur la commande via le biais des informations de connexion.
                $res = $cnx->query($req);

                // Boucle tant qu'il y a de lignes corespondantes à la requettes
                while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
                    (int) $dernierid = $ligne->id;
                }
            }
            
            
            // Atribution des données.
            $idserveur = $dernierid + 1;    // Identifiant actuel.

            $port = (25565 + $dernierid);   // Port de jeu

            $querry = (35565 + $dernierid); // Port JQuerry

            $rcon = (45565 + $dernierid);   // Port Rcon 

            $pass = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 1, 20); // Génération d'un mot de passe aléatoire.


            if (!$mysqli->query("INSERT INTO `ports` (`port`, `jquerry`, `rcon`, `rconmdp`) VALUES ('$port', '$querry', '$rcon', '$pass');")) {
                echo "<div class='alert alert-danger' role='alert'> Echec lors de l'ajout de vos données dans de la table ! </div>";    // Affichage de l'erreur.
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
