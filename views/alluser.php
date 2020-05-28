<?php
$user = $view["datas"]["users"];
?>

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
           <input type='submit' id='valider' value='<?=isset($view['datas']['user'])? "Modifier" : "Ajouter"; ?>'>
           </div>
         </form>
     </div>
<br>

<h2>Les utilisateurs </h2>

<table>
<tr>
<th>Nom</th>
<th>Prenom</th>
<th>Adresse E-Mail</th>
<th>Role</th>
<th>Pseudo</th>
</tr>
<?php foreach ($user as $us) : ?>
<tr>
<td><a href="index.php?route=all_user&id=<?=$us->getIdUtilisateur()?>"><?= $us->getNom()?></a></td>
<td><a href="index.php?route=all_user&id=<?=$us->getIdUtilisateur()?>"><?= $us->getPrenom()?></a></td>
<td><a href="index.php?route=all_user&id=<?=$us->getIdUtilisateur()?>"><?= $us->getAdresse()?></a></td>
<td><a href="index.php?route=all_user&id=<?=$us->getIdUtilisateur()?>"><?= $us->getRole()?></a></td>
<td><a href="index.php?route=all_user&id=<?=$us->getIdUtilisateur()?>"><?= $us->getPseudo()?></a></td>
<td><a href="index.php?route=delete_alluser&id=<?= $us->getIdUtilisateur()?>">Supprimer</a></td>
</tr>
<?php endforeach ?>
</table>
