<!-- Template qui permet d'afficher le menu fixe et les icones fixes pour chaque utilisateur de la plateforme -->

    <section class="categories">
        <h2> Mes catégories </h2>
        <div class="categories">
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