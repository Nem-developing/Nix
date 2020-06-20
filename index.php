<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="css/index.css" rel="stylesheet" type="text/css"/>
        <title>Minecraft-Web-Srv by Nem-developing</title>
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
                        <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
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

        <!-- Menu d'actions-->

        <div class="actions">
            <a href="pages/nouveau-serveur.php">
                <button type="button" class="btn btn-warning">Créer un nouveau serveur</button>
            </a>
            <a href="pages/suppression-serveur.php">
                <button type="button" class="btn btn-danger" id="btndelsrv">Supprimer un serveur</button>
            </a>
        </div>



        <!-- Liste des serveurs-->

        <div class="serveurs center">
            <?php
            include './config/config.php';  // Import des informations de connexion à la base de données.

            // Établissement de la connexion au serveur mysql.
            $cnx = new PDO("mysql:host=$hotedeconnexion;dbname=$basededonnee", "$utilisateur", "$motdepasse");
            // Commande SQL permetant de récupérer la liste des serveurs actifs.
            $req = 'SELECT * FROM `serveurs` where `actif` = "0";';
            // Envoie au serveur la commande via le biais des informations de connexion.
            $res = $cnx->query($req);

            // Boucle tant qu'il y a de lignes corespondantes à la requettes
            while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
                // Affichage des différents serveurs (Dans des éléments de type card.)
                echo "
                <div class='card' style='width: 18rem;'>
                <div class='card-body'>
                    <h5 class='card-title'>Serveur :<br>$ligne->nom</h5>
                    <p class='card-text'>État du serveur : <span id='online'>En ligne</span> / <span id='horsligne'>Hors ligne</span></p>
                </div>
                <ul class='list-group list-group-flush'>
                    <li class='list-group-item'>Nombre de joueurs Max : 150</li>
                    <li class='list-group-item'>Créé le : $ligne->datecreation</li>
                    <li class='list-group-item'>Version : $ligne->version</li>
                    <li class='list-group-item'>ID : $ligne->id</li>
                </ul>
                <div class='card-body'>
                    <a href='#' class='card-link'><svg class='bi bi-pencil' width='1em' height='1em' viewBox='0 0 16 16' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                        <path fill-rule='evenodd' d='M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z'/>a
                        <path fill-rule='evenodd' d='M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z'/></svg>Modifier le serveur</a><br>
                    <a href='#' class='btn btn-success'>Démarer</a>
                    <a href='#' class='btn btn-danger'>Eteindre</a>
                </div>
            </div>";   
            }
            ?>
        </div>








        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    </body>
</html>
