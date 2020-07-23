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
                            <li><a href="index.php?route=cours">Mes cours</a></li>
                            <li><a href="index.php?route=calendrier">Agenda</a></li>
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
 <h2>Mes Cours </h2>
<section>
<?php foreach ($cou as $cours) : ?>
<div class="col-5">
<p><button class="button" data-open="cours"><?= $cours->getTitre()?></button></p>
<div class="full reveal" id="cours" data-reveal>
  <div class="img-block"><img src="<?= $cours->getImage()?>" alt="<?= $cours->getMatiere()?>"></div>
  <h3><?= $cours->getMatiere()?></h3>
  <p><?= $cours->getContenu()?></p>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>
  </div>
  </section>
<?php endforeach ?>
