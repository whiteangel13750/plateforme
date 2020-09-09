<!-- Template qui permet d'afficher le menu fixe et les icones fixes pour chaque utilisateur de la plateforme -->

<?php if ($_SESSION==null){
                require "html/menu2.html";
                
                } else {
                require "html/menu.html";
            }
            ?>