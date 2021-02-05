<?php

session_start();
//si la session pour l'utilisateur correspondant à cet id est ouverte  alors on affiche :
if(isset($_SESSION['pseudo'])){
    echo 'Bonjour'." " . $_SESSION['pseudo'];
    
   

?>
<a href="deconnexion.php">Se deconnecter</a> 

<?php
 }else{//sinon on affiche les deux liens suivants
?>
    <a href="inscription.php">Inscription</a>
    <a href="connexion.php">Connexion</a>
<?php
 }
?> 

  
</body>
</html>