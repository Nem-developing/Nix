<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <link href="css/create.css" rel="stylesheet" type="text/css"/>
        <title>Créer un serveur</title>
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
            <p class="h1 breakshire" id="titrepage">Création d'un nouveau serveur</p>


            <!-- Formulaire de création d'un nouveau serveur-->


            <form action="action.php" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nom du nouveau serveur</label>
                    <input class="form-control form-control-lg" type="text" name="namesrv" placeholder="Exemple : Nemixcraft">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Version du serveur</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="version">
                        <option>1.15.2</option>
                        <option>1.15</option>
                        <option>1.14</option>
                        <option>1.13</option>
                        <option>1.12</option>
                        <option>1.11</option>
                        <option>1.10</option>
                        <option>1.9</option>
                        <option>1.8</option>
                        <option>1.7.10</option> 
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 boutonenvoie" value="ok">Créer le serveur</button>
            </form>
        </div>
    </center>








    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>
