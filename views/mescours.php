<?php
$comm = $view["datas"]["comment"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css\app.css">
    <title>La Plateforme</title>
</head>
<body>
    <menu>
        <ul>
            <div class="top-bar">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                    <li class="menu-text">
            <li><a href="index.php?route=membre">Accueil</a></li>
            <li><a href="index.php?route=insert_comment">Cours</a></li>
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
    </menu>

<h2> Ajout d'un commentaire</h2>
     <form action="index.php?route=<?=isset($view['datas']['com'])? "update_comment" : "insert_comment"; ?>" method="post">
             <div>
             <label> Commentaires : </label>
             <input type='textarea' id='description' name='description' placeholder="Intitulé de la tache" value='<?=isset($view['datas']['com'])? $view['datas']['com']->getDescription() : ""; ?>'>
             </div>
             <?=isset($view['datas']['com'])? "<input type='hidden' name='idComment' value='".$view['datas']['com']->getIdComment()."'>" : ""; ?>
             <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['com'])? "Modifier" : "Ajouter"; ?>'>
           </div>
         </form>
     </div>
<br>

<h2>Mes Commentaires </h2>
<?php foreach ($comm as $comment) : ?>
<a href="index.php?route=comment&id=<?= $comment->getIdComment()?>"><li><?= $comment->getDescription()?>  </a><a href="index.php?route=delete_comment&id=<?= $comment->getIdComment()?>">Supprimer</a></li>;
<?php endforeach ?>
