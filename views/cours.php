<?php
$cou = $view["datas"]["cours"];

?>

<!-- Vue qui permet d'afficher les cours de l'utilisateur, de les modifier et de les supprimer -->
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

<section class="row bg-light">
 <div class="col-6">
<h2> Ajouter un cours</h2>
     <form action="index.php?route=<?=isset($view['datas']['cou'])? "update_cours" : "insert_cours"; ?>" method="post">
             <div>
             <label> Cours :  </label>
             <input type="text" id='titre' name='titre' placeholder="Titre de mon cours" value="<?=isset($view['datas']['cou'])? $view['datas']['cou']->getTitre() : ""; ?>">
             </div>
             <div>
             <input type="text" id='image' name='image' placeholder="Image du cours" value="<?=isset($view['datas']['cou'])? $view['datas']['cou']->getImage() : "";?>">
             </div>
             <div>
             <input type="text"  id='matiere' name='matiere' placeholder="Matiere du cours" value="<?=isset($view['datas']['cou'])? $view['datas']['cou']->getMatiere() : ""; ?>">
             </div>
             <div>
             <textarea  id='contenu' name='contenu'><?=isset($view['datas']['cou'])? $view['datas']['cou']->getContenu() : "Contenu du cours"; ?></textarea>
             </div>
             <?=isset($view['datas']['cou'])? "<input type='hidden' name='idCours' value='".$view['datas']['cou']->getIdCours()."'>" : ""; ?>
             <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['cou'])? "Modifier" : "Ajouter"; ?>'>
           </div>
         </form>
         </div>
    </section>

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
<a href="index.php?route=delete_cours&id=<?= $cours->getIdCours()?>">Supprimer</a>
</section>
<?php endforeach ?>

