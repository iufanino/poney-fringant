<?php
    // Faire comprendre au navigateur ce qu'on lui répond :
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include('db.php');

    // Récupérer les données du formulaire : (méthode POST)
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {

        // Connexion à la base de donnée
        $dbconnexion = new PDO($url, $db_user, $db_pass);

        // Configuration (pour les exceptions), Pour afficher les erreurs dans le catch
        $dbconnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Écrire la requête de recherche de l'utliisateur 
        $rqt = "SELECT email, password FROM adherents WHERE email = :email";

        // Préparer la requête à partir de connexion à la base de données. Cette requête préparée s'appelle un statement
        $requetePreparee = $dbconnexion->prepare($rqt);

        // Associer la valeur (du formulaire) aux paramètres de requête préparée
        $requetePreparee->bindParam(':email', $email);

        // Éxecuter la requête 
        $requetePreparee->execute(); 

        // PDO::FETCH_ASSOC les résultats sont sous forme de tableau associatif (clé/valeur). fetch() permet de récupérer une ligne, fetchAll() toutes les lignes 
        $resultat = $requetePreparee->fetch(PDO::FETCH_ASSOC);


    } catch (Exception $exception) {
        // Si on a exception, c'est qu'il y a eu un problème et on affiche le message d'erreur et on quitte  
        echo $exception->getMessage();
    }

    // Si notre résultat ne contient rien, l'email' n'a pas été trouvé 
    if(!empty($resultat['email']) && !empty($resultat['password'])) {

        $hash = $resultat['password']; 

        // Test du mot de passe 
        $ok = password_verify($password, $hash);
    } 

    //On renvoye ces résultats en JSON : 
    //echo json_encode($resultat); 
     
    // Vérifier dans les headers si on a un content type application/json
    if(!empty($headers['Accept']) && $headers['Accept'] == 'application/json') {
        header('Content-Type: application/json');
        if($ok) {
            echo json_encode("Bienvenue !"); 
        } else {
             echo json_encode("");
        }
    } else  {
        header('Content-Type: text/html');
        if($ok) {
            echo "Bienvenue !"; 
        } else {
             echo "";
        }
    }
    

        

