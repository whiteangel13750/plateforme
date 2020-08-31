<?php

echo "<br>";
// Afiichage d'un message de bienvenue selon les roles et affichage du menu
if ($_SESSION['role'] == 'Enfant'){
     echo "Bienvenue sur votre espace Enfant,"." ". $_SESSION['prenom'] ." ". $_SESSION['nom'] ;

} else if($_SESSION['role'] == 'Professeur'){
     echo "Bienvenue sur votre espace Professeur,". " ". $_SESSION['prenom'] ." ". $_SESSION['nom'] ;
     
} else {
     echo "Bienvenue sur votre espace Parent,". " ". $_SESSION['prenom'] ." ". $_SESSION['nom'] ;
}

require "html/body.php";

?>

