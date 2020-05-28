<?php
$user = $view["datas"]["user"];
?>

<!DOCTYPE html>
 <html lang="fr">

    <head>
         <title>La plateforme</title>
         <meta charset="utf-8">
          <link rel="stylesheet" type="text/css" href="css/app.css">
     </head>   
 <body>
<menu>
        <ul>
            <div class="top-bar">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                    <li class="menu-text">
            <li><a href="index.php?route=membre">Accueil</a></li>
            <li><a href="index.php?route=insert_comment">Mes cours</a></li>
            <li><a href="">Agenda Perso</a></li>
            <li><a href="">Suivi</a></li>
            <li><a href="">Reseau social</a></li>
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

 <h2>Modifier ses coordonnées</h2>

 <section class="row bg-light">
     <div class="col-6">
     <form action="index.php?route=<?=isset($view['datas']['user'])? "update_user" : ""; ?>" method="post">
            <div>
            <label> Nom</label>
            <input type='text' id='nom' name='nom' placeholder="Votre nom"  value='<?=isset($view['datas']['user'])? $view['datas']['user']->getNom() : ""; ?>'>
            </div>
            <div>
            <label> Prenom</label>
            <input type='text' id='prenom' name='prenom' placeholder="Votre prenom"  value='<?=isset($view['datas']['user'])? $view['datas']['user']->getPrenom() : ""; ?>'>
            </div>
             <div>
             <label> Pseudo </label>
             <input type='text' id='pseudo' name='pseudo' placeholder="Votre pseudo"  value='<?=isset($view['datas']['user'])? $view['datas']['user']->getPseudo() : ""; ?>'>
             </div>
             <div>
                <label> Adresse Mail</label>
                <input type='text' id='adresse' name='adresse' placeholder="Votre adresse e-mail" required='required'  value='<?=isset($view['datas']['user'])? $view['datas']['user']->getAdresse() : ""; ?>'>
                </div>
             <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['user'])? "Modifier" : ""; ?>'>
           </div>
         </form>
     </div>
<br>

<p><button class="button" data-open="suppression">Suppression de votre compte</button></p>
<div class="reveal" id="suppression" data-reveal>
  <p class="lead">En cliquant sur ce bouton, cela supprimera votre compte. Etes vous sur de continuer?</p>
  <a href="index.php?route=delete_user&id=<?= $user->getIdUtilisateur()?>"> Supprimer votre compte</a>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>         
</section>

