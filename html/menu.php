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
                    <li class="menu-text"><li><a href="#">Accueil</a></li>
            <li><a href="index.php?route=insert_comment">Mes cours</a></li>
            <li><a href="">Agenda Perso</a></li>
            <li><a href="">Suivi</a></li>
            <li><a href="">Reseau social</a></li>
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
            <p class="cell medium-6 large-2"><img src="img\1.jpg" alt="Mes cours" data-toggle="exampleModal"><a href="index.php?route=insert_comment">Mes cours</a>
            <div class="img" id="exampleModal" data-reveal>
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <p class="cell medium-6 large-2"><img src="img\2.jpg" alt="" data-toggle="exampleModal1"> Mes documents
              <div class="img" id="exampleModal1" data-reveal>
              <button class="close-button" data-close aria-label="Close reveal" type="button">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <p class="cell medium-6 large-2"><img src="img\3.jpg" alt="" data-toggle="exampleModal2"> Mon agenda
              <div class="img" id="exampleModal2" data-reveal>
              <button class="close-button" data-close aria-label="Close reveal" type="button">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <p class="cell medium-6 large-2"><img src="img\4.jpg" alt="" data-toggle="exampleModal3"> Mes ressources
              <div class="img" id="exampleModal3" data-reveal>
              <button class="close-button" data-close aria-label="Close reveal" type="button">
                  <span aria-hidden="true">&times;</span>
              </button>
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