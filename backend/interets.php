<?php

    include('headers.php');
    include('db.php');

    if(session_status() != PHP_SESSION_ACTIVE) {
        session_start();

        if(empty($_SESSION['pseudo']))  {
            http_response_code(403);
            echo "Vous n'êtes pas connecter";
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
         
        echo $resultat;
        exit;
    }

    // On met à jour la liste des centres d'intérêts de l'utilisateur connecté
    if($_SERVER['REQUEST_METHOD'] == 'POST') { 

        $user = $_SESSION['id'];

        if(!empty($_POST['interets'])) {
            
            $interets = $_POST['interets'];
        }

        
        $rqt = "INSERT INTO interet_adherent (id_centre_interet, id_adherent) 
                VALUES (:interet, :user) " ;

        try {

            // Préparer la requête à partir de connexion à la base de données. Cette requête préparée s'appelle un statement
            $requetePreparee = $dbconnexion->prepare($rqt);
            
            foreach($interets as $interet ) {

                // Associer la valeur (du formulaire) aux paramètres de requête préparée
                $requetePreparee->bindParam("interet", $interet);
                $requetePreparee->bindParam("user", $user);
                
                // Éxecuter la requête 
                $requetePreparee->execute();
            }

        } catch (Exception $exception) {
            http_response_code(500);
            echo $exception->getMessage();
            exit;
        }

        echo  "La liste des centres d'intérêts à été modifié";

        header('location: ../pages/profil.html');

        exit();

    }
    
