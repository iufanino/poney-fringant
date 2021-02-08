<?php

    include('headers.php');
    include('db.php');

    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start();

        if(empty($_SESSION['pseudo']))  {
            http_response_code(403);
            echo json_encode(["status" => "error", "description" => "Vous n'êtes pas connecté"]);
            exit; 
        }
    }

    // On renvoi la liste des centres d'intérêts
    if($_SERVER['REQUEST_METHOD'] == 'GET') { 

        // Écrire la requête de recherche des centres d'interets 
        $rqt = "SELECT * FROM interets";
        
        // Préparer la requête à partir de connexion à la base de données. Cette requête préparée s'appelle un statement
        $requetePreparee = $dbconnexion->prepare($rqt);

        // Éxecuter la requête 
        $requetePreparee->execute(); 

        // PDO::FETCH_ASSOC les résultats sont sous forme de tableau associatif (clé/valeur). fetch() permet de récupérer une ligne, fetchAll() toutes les lignes 
        $resultat = $requetePreparee->fetch(PDO::FETCH_ASSOC);
         
        echo json_encode($resultat);
        exit;
    }

    // On met à jour la liste des centres d'intérêts de l'utilisateur connecté
    if($_SERVER['REQUEST_METHOD'] == 'POST') { 

        $user = $_SESSION['id'];

        $contentType = getallheaders()["Content-Type"];
        $centreInteret = array(); 

        if( $contentType == "application/json") {
            echo json_encode('');
        } else {
            // On considère que le front nous a renvoyé des checkbox. 
            

            if(!empty($_POST['interets'])) {

                $centreInteret = $_POST['interets'];
            }
        }

        $rqt = "INSERT INTO interet_adherent(id_centre_interet, id_adherent) 
                VALUES (:interet, :user) " ;

        try {
            $requetePreparee = $dbconnexion->prepare($rqt); 
            foreach($centreIntereT as $interet ) {
                $$requetePreparee->bindParam("interet", $interet);
                $$requetePreparee->bindParam("user", $user);
                $$requetePreparee->execute();
            }

        } catch (Exception $exception) {

            http_response_code(500);
            echo json_encode($exception->getMessage());
            exit;
        }

        echo json_encode(["status" => "ok", "description" => "La liste des centres d'intérêts à été mise à jour"]);
    }
    header('location: http://www.poney-fringant.local:9595/pages/profil.html');
    
