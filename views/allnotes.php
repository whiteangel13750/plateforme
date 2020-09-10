<?php
$notes = $view["datas"]["notes"];
$not = $view["datas"]["not"]?? null;
$users = $view["datas"]["users"];
$user = $view["datas"]["user"]?? null;
$mat = $view["datas"]["matiere"];

?>

<!-- Vue qui permet d'afficher tous les commentaires de l'utilisateur de les modifier et de les supprimer -->

<section class="row bg-light">
<div class="col-6">
<h2> Ajout d'une note</h2>
     <form action="index.php?route=<?=isset($view['datas']['not'])? "update_allnote" : "insert_allnote"; ?>" method="post">
            <div>
            <label>Veuillez choisir le nom de l'élève:
            <select name="ideleve" id="ideleve"> 
            <?php foreach ($users as $use) : ?> 
            <?php 
            // $selected=($use->getIdUtilisateur() == $notation->getIdEleve()) ? "selected" : ""; 
            echo '<option value="'.$use->getIdUtilisateur().'""'.$selected.'">' . $use->getNom() . ' ' . $use->getPrenom() .' (' .  $use->getRole() .')</option>';?>
            <?php endforeach ?>
            </select>
            </label>
            </div>
             <div>
             <label> Note : </label>
             <input type="number" id='note' name='note' value='<?=isset($view['datas']['not'])? $view['datas']['not']->getNote() : ""; ?>'>
             </div>
             <div>
             <label> Coefficient : </label>
             <input type="number" id='coeff' name='coeff' value='<?=isset($view['datas']['not'])? $view['datas']['not']->getCoeff() : ""; ?>'>
             </div>
             <div>
             <label>Matiere :</label>
              <select name="idmatiere" id="idmatiere">
              <?php foreach ($mat as $mati) : ?>
                <?php echo '<option value="'. $mati->getIdMatiere().'">' . $mati->getMatiere() . '</option>';?>
            <?php endforeach ?>
              </select>
              </div>
             <?=isset($view['datas']['not'])? "<input type='hidden' name='idNote' value='".$view['datas']['not']->getIdNote()."'>" : ""; ?>
             <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['not'])? "Modifier" : "Ajouter"; ?>'>
           </div>
         </form>
         </div>
    </section>

<h2>Les Notes </h2>
<table>
<?php foreach ($notes as $notation) : ?>
<tr>
<th>Eleve</th>
<th>Note</th>
<th>Coefficient</th>
<th>Matière</th>
<th>Supression</th>
</tr>
<tr>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getIdEleve()?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getNote()?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getCoeff()?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getIdMatiere()?></a></td>
<td><a href="index.php?route=delete_allnote&id=<?= $notation->getIdNote()?>">Supprimer</a></td>
<?php endforeach ?>
</table>