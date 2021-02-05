
<?php

session_start();

if(isset($_SESSION['pseudo'])){
    
    include '../frontend/pages/profil.html';

?>

<html>
    <head>
        <title></title>
    </head>
    <body> 
        <header>
            <ul>
               <a href="profil.php">Mon profil</a>
               <a href="connexion.php">Se deconnecter</a>
            </ul>
        </header>

        <p>
            <?php echo 'Bonjour'." " . $_SESSION['pseudo']; ?>
        </p>
    </body>
</html>
 
<?php

} else {

?>

<html>
    <head>
        <title></title>
    </head>
    <body> 
        <header>
            <ul>
               <a href="inscription.php">Inscription</a>
               <a href="connexion.php">Connexion</a>
            </ul>
        </header>

        <p>
            <?php echo 'Bonjour ! Connectez-vous' ?>
        </p>
    </body>
</html>

<?php

}

?> 



