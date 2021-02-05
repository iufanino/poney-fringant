<?php
    
    include('headers.php');
    include('db.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Récupérer les données du formulaire : (méthode POST)
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Écrire la requête de recherche de l'utliisateur 
    $rqt = "SELECT pseudo, email, password FROM adherents WHERE pseudo = :pseudo OR email = :email LIMIT 1";

    // Connexion à la base de donnée
    $dbconnexion = new PDO($url, $db_user, $db_pass);

    // Configuration (pour les exceptions), Pour afficher les erreurs dans le catch
    $dbconnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {

       // Préparer la requête à partir de connexion à la base de données. Cette requête préparée s'appelle un statement
        $requetePreparee = $dbconnexion->prepare($rqt);

        // Associer la valeur (du formulaire) aux paramètres de requête préparée
        $requetePreparee->bindParam(':pseudo', $pseudo);
        $requetePreparee->bindParam(':email', $email);

        // Éxecuter la requête 
        $requetePreparee->execute(); 

        // PDO::FETCH_ASSOC les résultats sont sous forme de tableau associatif (clé/valeur). fetch() permet de récupérer une ligne, fetchAll() toutes les lignes 
        $resultat = $requetePreparee->fetch(PDO::FETCH_ASSOC);

    } catch (Exception $exception) {
        // Si on a exception, c'est qu'il y a eu un problème et on affiche le message d'erreur et on quitte  
        echo $exception->getMessage();
    }

    // Si notre résultat ne contient rien, le pseudo ou l'email n'a pas été trouvé 
    if(!empty(($resultat['pseudo']) || ($resultat['email'])) && !empty($resultat['password'])) {

        $hash = $resultat['password']; 

       // Test du mot de passe 
        $passOk = password_verify($password, $hash);

        if($passOk && session_status() != PHP_SESSION_ACTIVE) {
            session_start();

            $_SESSION['pseudo'] = $resultat['pseudo'];
            $_SESSION['email'] = $resultat['email'];
       

            setcookie('pseudo', $_POST['pseudo']);
            setcookie('email', $_POST['email']);
            setcookie('password', $_POST['password']);
        
            //header('location: ../profil.php');
            header('location: http://www.poney-fringant.local:9595/pages/profil.html');
        }

    } 

    // Vérifier dans les headers si on a un content type application/json
   /* if(!empty($headers['Accept']) && $headers['Accept'] == 'application/json') {
        header('Content-Type: application/json');
        if($passOk) {
            
            header('Location: index.html');
            echo json_encode("Bienvenue !"); 
        } else {
             echo json_encode("");
        }
    } else  {
        header('Content-Type: text/html');
        if($passOk) {
            echo "Bienvenue !"; 
        } else {
             echo "";
        }
    }*/
    

        

