<?php
    
    include('headers.php');
    include('db.php');

    // Récupérer les données du formulaire : (méthode POST)
    $identifiant = $_POST['identifiant'];
    $password = $_POST['password'];

    // Écrire la requête de recherche de l'utliisateur 
    $rqt = "SELECT id_adherent ,pseudo, password FROM adherents WHERE pseudo = :input OR email = :input LIMIT 1";

    try {

        // Préparer la requête à partir de connexion à la base de données. Cette requête préparée s'appelle un statement
        $requetePreparee = $dbconnexion->prepare($rqt);

        // Associer la valeur (du formulaire) aux paramètres de requête préparée
        $requetePreparee->bindParam("input", $identifiant);

        // Éxecuter la requête 
        $requetePreparee->execute(); 

        // PDO::FETCH_ASSOC les résultats sont sous forme de tableau associatif (clé/valeur). fetch() permet de récupérer une ligne, fetchAll() toutes les lignes 
        $resultat = $requetePreparee->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $exception) {

        http_response_code(500);
        echo json_encode($exception->getMessage());
        exit;
        //echo $exceptionè>getMessage();
    }

    // Si notre résultat ne contient rien, le pseudo ou l'email n'a pas été trouvé 
    if(!empty($resultat['pseudo']) && !empty($resultat['password'])) {

        $hash = $resultat['password']; 

       // Test du mot de passe 
        $passOk = password_verify($password, $hash);

        if($passOk && session_status() != PHP_SESSION_ACTIVE) {

            session_start();

            $_SESSION['id'] = $resultat['id_adherent'];
            $_SESSION['pseudo'] = $resultat['pseudo'];
          
            echo json_encode(["status" => "ok", "connected" => true, "pseudo" => $_SESSION['pseudo'], "avatar" => null, "description" => "Connexion réussie", 'sessionObject' => $_SESSION]);
            header('location: http://www.poney-fringant.local:9595/pages/profil.html');
            exit();
        
        } else {

            http_response_code(400); 
            echo json_encode(["status" => "error", "connected" => false, "description" => "Pseudo ou email ou mot de passe invalide"]);
        }

    } 


        

