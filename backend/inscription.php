<?php
    
    include('headers.php');
    include('db.php');

    // Récupérer les données du formulaire d'enregistrement : (méthode POST)
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo']; 
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $numero_adherent = $_POST['numero_adherent'];
    $password = $_POST['password'];
    $pass_conf = $_POST['password_confirmation']; 
    $adresse = $_POST['adresse'];
    $code_postal = $_POST['code_postal'];
    $ville = $_POST['ville'];
    $id = $_POST['id'];

    // Valider les données d'enregistrement 

    // Vérifier le nombre maximal de caractères par rapport aux types renseigné lors de la création de la BDD
      if(strlen($pseudo) > 25 || strlen($email) > 50) {
        echo "Le pseudo ou le mail est trop long"; 
        exit; 
    }

    // Vérifier le format de l'email avec le filtre de validation des emails (la fonction filter_var)
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Le format de l'adresse e-mail est incorrect"; 
        exit; 
    }

    // Vérifier la présence des mots de passe et l'égalité de mot de passe et de sa confirmation
    if( $password != $pass_conf) {
        echo "Les mots de passes sont différents"; 
        exit; 
    }

    // Vérifier le format de code postal avec le filtre de validation (la fonction filter_var)
    if(!filter_var($code_postal, FILTER_VALIDATE_INT)) {
        echo "Le format de code postal est incorrect"; 
        exit; 
    }

    try {

        // Écrire la requête de recherche de l'utliisateur 
        $rqt = "SELECT * FROM adherents WHERE pseudo=:pseudo OR email=:email";
     
        // Préparer la requête à partir de connexion à la base de données. Cette requête préparée s'appelle un statement
        $requetePreparee = $dbconnexion->prepare($rqt);

        // Associer les valeurs (du formulaire) aux paramètres de requête préparée 
        $requetePreparee->bindParam(':pseudo', $pseudo);
        $requetePreparee->bindParam(':email', $email);

        // Exécuter la requête 
        $requetePreparee->execute();

        // Si on a un résultat, ça veut dire que le pseudo ou l'email est déjà pris
        if($requetePreparee->fetch() != false) {
            echo "Email ou pseudo déjà enregistré"; 
            exit;
        }

        // Hashage du mot de passe
        $hash = password_hash($password, PASSWORD_DEFAULT); 

        // Écrire la requête d'insertion
        $rqt = "INSERT INTO adherents (nom, prenom, pseudo, email, tel, numero_adherent, password, adresse, code_postal, ville) 
                VALUES (:nom, :prenom, :pseudo, :email, :tel, :numero_adherent, :password, :adresse, :code_postal, :ville)";

        // Préparer la requête
        $requetePreparee = $dbconnexion->prepare($rqt);

        // Associer les valeurs (du formulaire) aux paramètres de requête préparée 
        $requetePreparee->bindParam(':nom', $nom);
        $requetePreparee->bindParam(':prenom', $prenom);
        $requetePreparee->bindParam(':pseudo', $pseudo);
        $requetePreparee->bindParam(':email', $email);
        $requetePreparee->bindParam(':tel', $tel);
        $requetePreparee->bindParam(':numero_adherent', $numero_adherent);
        $requetePreparee->bindParam(':password', $hash);
        $requetePreparee->bindParam(':adresse', $adresse);
        $requetePreparee->bindParam(':code_postal', $code_postal);
        $requetePreparee->bindParam(':ville', $ville);

        // Exécuter la requête 
        $requetePreparee->execute();

        // Vérifier le nombre de ligne insérée (1 normalement)
        $nombreLignesModifiee = $requetePreparee->rowCount();

        if($nombreLignesModifiee != 1) {
            echo "Problème lors de l'enregistrement";
            exit;
        } else {

            // Gestion des sessions 
            session_start(); 
            $_SESSION['id'] = $dbconnexion->lastInsertId(); 
            $_SESSION['pseudo'] = $pseudo;

            header('location: ../pages/interets.html');
            exit();
            //echo "Bienvenue $pseudo, tu es bien enregistré.";
        } 

    } catch (Exception $exception) {
        // Si on a exception, c'est qu'il y a eu un problème et on affiche le message d'erreur et on quitte  
        echo $exception->getMessage();
        //echo json_encode($exception);
    }