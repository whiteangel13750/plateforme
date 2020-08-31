<?php
$cou = $view["datas"]["cours"];
$comm = $view["datas"]["comment"];

?>

<!-- Vue qui permet d'afficher tous les cours des utilisateurs -->

 <h2>Mes Cours </h2>
 <section>
 <div class="col-5">
<?php foreach ($cou as $cours) : ?>
<p><button class="button" data-open="cours-<?= $cours->getIdCours()?>"><?= $cours->getTitre()?></button></p>
<div class="full reveal" id="cours-<?= $cours->getIdCours()?>" data-reveal>
  <div class="img-block"><img src="<?= $cours->getImage()?>" alt="<?= $cours->getMatiere()?>"></div>
  <h3><?= $cours->getMatiere()?></h3>
  <p><?= $cours->getContenu()?></p>

  <h2>Les Commentaires </h2>
<?php foreach ($comm as $comment) : ?>
<a href="index.php?route=all_comment&id=<?= $comment->getIdComment()?>"><li><?= $comment->getDescription()?>  </a><a href="index.php?route=delete_allcomment&id=<?= $comment->getIdComment()?>">Supprimer</a></li>;
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
</section>