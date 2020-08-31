<?php
$user = $view["datas"]["users"];
?>

<!-- Vue qui permet d'afficher tous les utilisateurs, de les modifier et de les supprimer -->

 <section class="row bg-light">
     <div class="col-6">
        <h2>Modifier ses coordonnées</h2>
        <form action="index.php?route=<?=isset($view['datas']['user'])? "update_alluser" : ""; ?>" method="post">
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
             <?=isset($view['datas']['user'])? "<input type='hidden' name='idUser' value=".$view['datas']['user']->getIdUtilisateur()."'>" : ""; ?>
             <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['user'])? "Modifier" : "Ajouter"; ?>'>
           </div>
         </form>
     </div>
    </section>


<h2>Les utilisateurs </h2>

<table>
<tr>
<th>Nom</th>
<th>Prenom</th>
<th>Adresse E-Mail</th>
<th>Role</th>
<th>Pseudo</th>
<th>Suppression</th>
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
