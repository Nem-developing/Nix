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
        if (!$_GET['id']){
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
        $req = 'SELECT * FROM serveurs where id = "'.$id.'"';
        // Envoie au serveur la commande via le biais des informations de connexion.
        $res = $cnx->query($req);

        // Boucle tant qu'il y a de lignes corespondantes à la requettes donc seulement une.
        while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
            $nom = $ligne->nom;
        }
        $req = 'SELECT * FROM `server.properties` where id = "'.$id.'"';
        // Envoie au serveur la commande via le biais des informations de connexion.
        $res = $cnx->query($req);

        // Boucle tant qu'il y a de lignes corespondantes à la requettes donc seulement une.
        while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
            $querryport = $ligne->queryport;
            $joueursmax = $ligne->maxplayers;
        }
        
        
        
        
        
        ?>
        
        
        


        <! -- Titre de la page -->
        <div id="page">
            <p class="h1 breakshire" id="titrepage">Modification du serveur <?php echo"$nom";?></p>


            <!-- Formulaire de création d'un nouveau serveur-->

            
            <form action="../actions/modifier.php" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nom du serveur</label>
                    <input class="form-control form-control-lg" type="text" name="namesrv" value="<?php echo"$nom";?>" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Nombre maximum de joueurs (Actuellement : <?php echo"$joueursmax";?>).</label>
                    <select multiple class="form-control" id="exampleFormControlSelect2" name="joueursmax">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>30</option>
                        <option>40</option>
                        <option>50</option>
                        <option>60</option>
                        <option>70</option>
                        <option>80</option>
                        <option>90</option>
                        <option>100</option>
                        <option>200</option>
                        <option>300</option>
                        <option>400</option>
                        <option>500</option>
                        <option>600</option>
                        <option>777</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2"> Numéro du port pour JQuerry.</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo"$querryport";?>" disabled>
                </div>
                <button type="submit" class="btn btn-primary mb-2 boutonenvoie" value="ok">Modifier le serveur</button>
            </form>
        </div>
    








    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>
