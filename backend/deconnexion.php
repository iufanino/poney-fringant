<?php
    
    include('headers.php');
    // Pour déconnecter l'utilisateur, il faut détruire la session

    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }

        // "Vider" les variable de session
        session_unset(); 
        // Détruire la session
        session_destroy(); 

header('location: http://www.poney-fringant.local:9595/index.html');
