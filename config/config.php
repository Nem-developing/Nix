<?php

/*  
 *  =========================================================================
 *  Veuillez spécifiez les informations de connection à votre base de donnée.
 * 
 *  Besoin d'aide ? Consultez la documentation !
 *  https://github.com/Nem-developing/minecraft-web-srv/wiki#base-de-donn%C3%A9es-
 *  =========================================================================
 */ 

$hotedeconnexion = "127.0.0.1"; // 127.0.0.1 = Localhost
$basededonnee = "Nix";
$utilisateur = "Nix-USER";
$motdepasse = "Nix-PASSWORD";


/*  
 *  ===================================================================================
 *  Veuillez spécifiez les arguments de lancement par défaut des nouveaux sereveurs.
 * 
 *  Par défaut 1Go de RAM est alloué.
 * 
 *  Les arguments : 
 * 
 *  -Xms = Allocation de mémoire au démarrage du programe.
 *  -Xmx = Mémoire maximal que le programe pourra utiliser.
 * 	
 *  Vous pouvez par exemple allouer 512Mo au démarrage & 1Go maximal pour le serveur.
 *  ---> "-Xms512M -Xmx1G"
 *  ===================================================================================
 */ 


$commandedelancement = "-Xms1G -Xmx1G";


?>
