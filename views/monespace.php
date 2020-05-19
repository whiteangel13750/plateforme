<?php
if ($_SESSION['role'] == 'Enfant'){
     echo "Vous êtes sur l'espace Enfant";

} else if($_SESSION['role'] == 'Professeur'){
     echo "Vous êtes sur l'espace Professeur";
     
} else {
     echo "Vous êtes sur l'espace Parent";
}

require "html/menu.html";

if ($_SESSION['role'] == 'Enfant'){
     require "html/menueleve.html";

} else if($_SESSION['role'] == 'Professeur'){
     require "html/menuprof.html";
     
} else {
     require "html/menuparent.html";
}


?>

