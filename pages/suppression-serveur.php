<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="css/suppression-serveur.css" rel="stylesheet" type="text/css"/>
        <title>Supprimer un serveur</title>
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


        <! -- Titre de la page -->
    <center>
        <div id="page">


            <!-- Tableau avec tout les serveurs. -->



            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Version</th>
                        <th scope="col">Date de création</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>





                    <?php
                    include '../config/config.php';  // Import des informations de connexion à la base de données.
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
                                <tr>
                                    <th scope='row'>$ligne->id</th>
                                    <td>$ligne->nom</td>
                                    <td>$ligne->version</td>
                                    <td>$ligne->datecreation</td>
                                    <td><button type='button' class='btn btn-danger'>Supprimer le serveur</button></td>
                                </tr>
                             ";
                    
                    }
                    ?>



                </tbody>
            </table>








        </div>
    </center>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>
