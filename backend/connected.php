<?php
    include('headers.php');

    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start(); 
    }
    
    if(!empty($_SESSION['pseudo'])) {
        echo json_encode(["connected" => true, "pseudo" => $_SESSION['pseudo']]);
    } else {
        http_response_code(400);
        echo json_encode(["connected" => false]);
    }