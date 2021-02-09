<?php

   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

    // Fichier contenant les entêtes pour les réponses HTTP
    
    header ('Content-Type: application/json');
    header('Access-Control-Allow-Credentials: true'); 
    header ('Access-Control-Allow-Origin: http://www.poney-fringant.local:9595');

   
