<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\app.css">
    <title>La Plateforme</title>
</head>
<body>
    <menu>
        <ul>
            <div class="top-bar">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                    <li class="menu-text">
            <li><a href="index.php?route=membre">Accueil</a></li>
            <li><a href="index.php?route=insert_comment">Cours</a></li>
            <li><a href="">Agenda</a></li>
            <li><a href="">Suivi</a></li>
            <li><a href="index.php?route=user">Mon profil</a></li>
        <?php 
    if ($_SESSION['role'] == 'Enfant'){
    require "html/menueleve.html";

    } else if($_SESSION['role'] == 'Professeur'){
    require "html/menuprof.html";
    
    } else {
    require "html/menuparent.html";
}
    ?>


            <li><a href="index.php?route=deconnect">Me deconnecter</a></li>
        </ul>
    </div>
</div>
    </menu>

    <section class="categories">
        <div class="grid-x grid-padding-x">
            <p class="cell medium-6 large-2"><img src="img\1.jpg" alt="Cours" data-toggle="exampleModal"><a href="index.php?route=insert_comment">Cours</a>
            <p class="cell medium-6 large-2"><img src="img\2.jpg" alt="" data-toggle="exampleModal1"> Mes documents
            <p class="cell medium-6 large-2"><img src="img\3.jpg" alt="" data-toggle="exampleModal2"> Mon agenda
            <p class="cell medium-6 large-2"><img src="img\4.jpg" alt="" data-toggle="exampleModal3"> Mes ressources
        </div>
                <?php if ($_SESSION['role'] == 'Enfant'){
                require "html/bodyeleve.html";

                } else if($_SESSION['role'] == 'Professeur'){
                require "html/bodyprof.html";
                
                } else {
                require "html/bodyparent.html";
            }
            ?>
        </div>
    </section>
</body>
</html> 