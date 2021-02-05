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

//setcookie('pseudo', null, strtotime("-1 day"));
//setcookie('email', null, strtotime("-1 day"));
//setcookie('password', null, strtotime("-1 day"));

header('location: http://www.poney-fringant.local:9595/index.html');
