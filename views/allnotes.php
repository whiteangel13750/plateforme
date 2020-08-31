<?php
$note = $view["datas"]["notes"];
$user = $view["datas"]["user"];
$mat = $view["datas"]["matiere"];
var_dump($mat);
?>

<!-- Vue qui permet d'afficher tous les commentaires de l'utilisateur de les modifier et de les supprimer -->

<section class="row bg-light">
<div class="col-6">
<h2> Ajout d'une note</h2>
     <form action="index.php?route=<?=isset($view['datas']['not'])? "update_allnote" : "insert_note"; ?>" method="post">
            <div>
             <label>Veuillez choisir un élève :
        <select name="eleve" id="eleve">
    <optgroup>
    <?php foreach ($user as $use) : ?>
     <?php echo '<option value="'. $use->getNom().' '. $use->getPrenom().'">' . $use->getNom() . ' ' . $use->getPrenom() .' (' .  $use->getRole() .')</option>';?>
      <?php endforeach ?>
    </optgroup>
    </select>
            </div>
             <div>
             <label> Note : </label>
             <input type="number" id='note' name='note'><?=isset($view['datas']['not'])? $view['datas']['not']->getNote() : ""; ?></input>
             </div>
             <div>
             <label> Coefficient : </label>
             <input type="number" id='coeff' name='coeff'><?=isset($view['datas']['not'])? $view['datas']['not']->getCoeff() : ""; ?></input>
             </div>
             <label>Matiere :
            <select name="matiere" id="matiere">
    <optgroup>
    <?php foreach ($matiere as $mat) : ?>
     <?php echo '<option value="'. $mat->getMatiere().' '.'</option>';?>
      <?php endforeach ?>
    </optgroup>
    </select>
             <?=isset($view['datas']['not'])? "<input type='hidden' name='idNote' value='".$view['datas']['not']->getIdNote()."'>" : ""; ?>
             <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['not'])? "Modifier" : "Ajouter"; ?>'>
           </div>
         </form>
         </div>
    </section>

<h2>Les Notes </h2>
<table>
<?php foreach ($note as $notation) : ?>
<tr>
<th>Eleve</th>
<th>Note</th>
<th>Coefficient</th>
<th>Matière</th>
<th>Supression</th>
</tr>
<tr>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getEleve()?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getNote()?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getCoeff()?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getMatiere()?></a></td>
<td><a href="index.php?route=delete_allnote&id=<?= $notation->getIdNote()?>">Supprimer</a></td>
<?php endforeach ?>
</table>