<?php
$comm = $view["datas"]["comment"];

?>

<!-- Vue qui permet d'afficher tous les commentaires, de les modifier et de les supprimer -->


<section class="row bg-light">
  <div class="col-6">
  <h2> Modification d'un commentaire</h2>
     <form action="index.php?route=<?=isset($view['datas']['com'])? "update_allcomment" : ""; ?>" method="post">
             <div>
             <label> Commentaires : </label>
             <input type="text" id='description' name='description' placeholder="Intitulé de la tache" value="<?=isset($view['datas']['com'])? $view['datas']['com']->getDescription() : ""; ?>">
             </div>
             <?=isset($view['datas']['com'])? "<input type='hidden' name='idComment' value=".$view['datas']['com']->getIdComment()."'>" : ""; ?>
             <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['com'])? "Modifier" : "Modifier"; ?>'>
           </div>
         </form>
         </div>
    </section>

<h2>Mes Commentaires </h2>
<?php foreach ($comm as $comment) : ?>
<a href="index.php?route=all_comment&id=<?= $comment->getIdComment()?>"><li><?= $comment->getDescription()?>  </a><a href="index.php?route=delete_allcomment&id=<?= $comment->getIdComment()?>">Supprimer</a></li>;
<?php endforeach ?>
