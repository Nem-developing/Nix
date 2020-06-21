<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        // Si un utilisateur tente d'accéder à cette page sans passer par les boutons adaptés, alors on va l'éjecter.
        if (!$_GET['id'] or !$_GET['action']){
            header('Location: ../index.php');   // redireciton vers la page d'acceuil.
            exit();
        }
        
        
        ?>
        
    </body>
</html>
