<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // Si un utilisateur tente d'accéder à cette page sans passer par les boutons adaptés, alors on va l'éjecter.
        if (!$_GET['id'] or!$_GET['action']) {
            header('Location: ../index.php');   // redireciton vers la page d'acceuil.
            exit();
        }

        $id = $_GET['id'];
        $action = $_GET['action'];

        switch ($action) {
            case "lancer":
                echo "Démmarage du serveur";
                
                shell_exec("cd /home/mwsrv-user/$id ; sh start_avec_screen.sh");
                
                break;
            case "stopper":
                echo "Extinction du serveur";
                shell_exec("screen -S serveur_$id -p 0 -X stuff `printf 'stop\r'`");
                break;
        }
        
        
        ?>

    </body>
</html>
