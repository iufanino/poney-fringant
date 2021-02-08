<?php

    include('headers.php');
    include('db.php');

    // On vérifie que l'utilisateur est bien connecté
    if(empty($_SESSION['pseudo'])) {
        http_response_code(403);
        exit; 
    }

    $filtre = false; 
    // On regarde s'il existe un champ de recherche (la méthode est GET) 
    if(!empty($_GET['pseudo'])) {
        // Un utilisateur est recherché 
        $filtre = $_GET['pseudo'];
    }

    
   