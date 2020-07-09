<?php
$cou = $view["datas"]["cours"];

?>

<!-- Vue qui permet d'afficher tous les cours des utilisateurs -->
    <nav>
            <div class="top-bar">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                            <li class="menu-text">
                            <li><a href="index.php?route=membre">Accueil</a></li>
                            <li><a href="index.php?route=all_cours">Mes cours</a></li>
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
    </nav>

<section>
    <h2>Mes Cours </h2>
    <?php foreach ($cou as $cours) : ?>
            <img src="<?= $cours->getImage()?>" alt="" height="352" width="470">
            <h3><?= $cours->getTitre()?></h3>
            <h4><?= $cours->getTitre()?></h4>
            <h5><?= $cours->getMatiere()?></h5>
            <p><?= $cours->getContenu()?></p></a>
            <p>**************************</p>
        </div>
    <?php endforeach ?>
</section>