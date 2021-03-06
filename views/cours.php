<?php
$cou = $view["datas"]["cours"];
$mat = $view["datas"]["matiere"];

?>

<!-- Vue qui permet d'afficher les cours de l'utilisateur, de les modifier et de les supprimer -->

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
             <label>Matiere :</label>
              <select name="idmatiere" id="idmatiere">
              <?php foreach ($mat as $mati) : ?>
                <?php echo '<option value="'. $mati->getIdMatiere().'">' . $mati->getMatiere() . '</option>';?>
            <?php endforeach ?>
            </select>
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

<section class="categories">
  <div class="categories">
    <div class="grid-x grid-padding-x">
        <?php foreach ($cou as $cours) : ?>
            <a href="index.php?route=cours&id=<?= $cours->getIdCours()?>">
                <article class="small-1 medium-6 large-4">
                          <figure>
                              <img src="<?= $cours->getImage()?>" alt="" data-open="cours-<?= $cours->getIdCours()?>">
                              <figcaption class="figtext"><?= $cours->getTitre()?></figcaption>
                          </figure>
                            <div class="full reveal" id="cours-<?= $cours->getIdCours()?>" data-reveal>
                                  <div class="img-block">
                                      <img src="<?= $cours->getImage()?>" alt="<?= $cours->getIdMatiere()?>">
                                   </div>
                                        <p><?= $cours->getContenu()?></p>
                                    <button class="close-button" data-close aria-label="Close modal" type="button">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                               </div>
                               <a href="index.php?route=delete_cours&id=<?= $cours->getIdCours()?>">Supprimer</a>
                      </article>
          <?php endforeach ?>
        </div>
    </div>
</section>

