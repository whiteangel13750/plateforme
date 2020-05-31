<?php

// Afiichage d'un message de bienvenue selon les roles et affichage du menu
if ($_SESSION['role'] == 'Enfant'){
     echo "Bienvenue sur votre espace Enfant";

} else if($_SESSION['role'] == 'Professeur'){
     echo "Vous êtes sur l'espace Professeur";
     
} else {
     echo "Vous êtes sur l'espace Parent";
}

require "html/menu.php";

?>

