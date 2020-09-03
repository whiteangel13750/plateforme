<?php
$cou = $view["datas"]["cours"];
$comm = $view["datas"]["comment"];

?>

<!-- Vue qui permet d'afficher tous les cours des utilisateurs -->

 <h2>Mes Cours </h2>
<section class="categories">
  <div class="categories">
    <div class="grid-x grid-padding-x" style='border: 1px solid red'>
      <div class="small-1 medium-6 large-4">
        <?php foreach ($cou as $cours) : ?>
          <button><img src="<?= $cours->getImage()?>" alt="" data-open="cours-<?= $cours->getIdCours()?>"><figcaption id="figtext"><?= $cours->getTitre()?></figcaption></button>
          <div class="full reveal" id="cours-<?= $cours->getIdCours()?>" data-reveal>
              <div class="img-block"><img src="<?= $cours->getImage()?>" alt="<?= $cours->getMatiere()?>">
              </div>
              <h3><?= $cours->getMatiere()?></h3>
              <p><?= $cours->getContenu()?></p>

            <h2>Les Commentaires </h2>
            <?php foreach ($comm as $comment) : ?>
              <li><a href="index.php?route=all_comment&id=<?= $comment->getIdComment()?>"><?= $comment->getDescription()?></a><a href="index.php?route=delete_allcomment&id=<?= $comment->getIdComment()?>">Supprimer</a></li>
            <?php endforeach ?>


            <h2> Ajout d'un commentaire</h2>
            <form action="index.php?route=<?=isset($view['datas']['com'])? "update_comment" : "insert_comment"; ?>" method="post">
             <div>
                <label> Commentaires : </label>
               <textarea id='description' name='description'><?=isset($view['datas']['com'])? $view['datas']['com']->getDescription() : "Saississez votre commentaire"; ?></textarea>
             </div>
              <?=isset($view['datas']['com'])? "<input type='hidden' name='idComment' value='".$view['datas']['com']->getIdComment()."'>" : ""; ?>
             <div>
               <input type='submit' id='valider' value='<?=isset($view['datas']['com'])? "Modifier" : "Ajouter"; ?>'>
              </div>
            </form>

            <button class="close-button" data-close aria-label="Close modal" type="button">
               <span aria-hidden="true">&times;</span>
             </button>
            </div>
          <?php endforeach ?>
        </div>
    </div>
  </div>
</section>