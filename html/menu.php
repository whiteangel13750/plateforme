<!-- Template qui permet d'afficher le menu fixe et les icones fixes pour chaque utilisateur de la plateforme -->

<nav>
            <div class="top-bar">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                    <li class="menu-text">
            <li><a href="index.php?route=membre">Accueil</a></li>
            <li><a href="index.php?route=cours">Mes cours</a></li>
            <li><a href="index.php?route=calendrier">Agenda</a></li>
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
</nav>

    <section class="categories">
        <h2> Mes catégories </h2>
        <div class="grid-x grid-padding-x">
            <p class="cell medium-4 large-2"><img src="img/1.jpg" alt="" data-toggle="exampleModal"><a href="index.php?route=all_cours">Mes cours</a>
            <p class="cell medium-4 large-2"><img src="img/2.jpg" alt="" data-toggle="exampleModal1"> Mes documents
            <p class="cell medium-4 large-2"><img src="img/3.jpg" alt="" data-toggle="exampleModal2"> Mon agenda
            <p class="cell medium-4 large-2"><img src="img/4.jpg" alt="" data-toggle="exampleModal3"> Mes ressources
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