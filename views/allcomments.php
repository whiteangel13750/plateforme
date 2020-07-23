<?php
$comm = $view["datas"]["comment"];

?>

<!-- Vue qui permet d'afficher tous les commentaires, de les modifier et de les supprimer -->
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
