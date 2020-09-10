<?php
$notes = $view["datas"]["notes"];
$eleves = $view["datas"]["eleves"];
$matieres = $view["datas"]["matieres"];

?>

<!-- Vue qui permet d'afficher tous les commentaires de l'utilisateur de les modifier et de les supprimer -->

<section class="row bg-light">
  <div class="col-6">
  <h2> Ajout d'une note</h2>
    <form action="index.php?route=<?=isset($view['datas']['note'])? "update_allnote" : "insert_allnote"; ?>" method="post">
        <div>
          <label>Veuillez choisir le nom de l'élève:</label>
          <select name="ideleve" id="ideleve"> 
            <?php if(isset($view['datas']['note'])): ?>
              <option value="<?= $view['datas']['note']->getIdEleve() ?>" selected><?= $view['datas']['note']->eleve ?></option>
            <?php else: ?>
              <?php foreach ($eleves as $eleve) : ?> 
                <option value="<?= $eleve['id_user'] ?>"><?= $eleve['nom'] . ' ' . $eleve['prenom'] ?></option>
              <?php endforeach ?>
            <?php endif ?>
          </select>
        </div>
        <div>
          <label> Note : </label>
          <input type="number" id='note' name='note' value='<?=isset($view['datas']['note'])? $view['datas']['note']->getNote() : ""; ?>'>
        </div>
        <div>
          <label> Coefficient : </label>
          <input type="number" id='coeff' name='coeff' value='<?=isset($view['datas']['note'])? $view['datas']['note']->getCoeff() : ""; ?>'>
        </div>
        <div>
          <label>Matiere :</label>
          <select name="idmatiere" id="idmatiere">
            <?php if(isset($view['datas']['note'])): ?>
              <option value="<?= $view['datas']['note']->getIdMatiere() ?>" selected><?= $view['datas']['note']->matiere ?></option>
            <?php else: ?>
              <?php foreach ($matieres as $matiere) : ?> 
                <option value="<?= $matiere->getIdMatiere() ?>"><?= $matiere->getMatiere() ?></option>
              <?php endforeach ?>
            <?php endif ?>
          </select>
          </div>
          <?=isset($view['datas']['note'])? "<input type='hidden' name='idNote' value='".$view['datas']['note']->getIdNote()."'>" : ""; ?>
          <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['note'])? "Modifier" : "Ajouter"; ?>'>
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
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->eleve ?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getNote()?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->getCoeff()?></a></td>
<td><a href="index.php?route=all_notes&id=<?= $notation->getIdNote()?>"><?= $notation->matiere ?></a></td>
<td><a href="index.php?route=delete_allnote&id=<?= $notation->getIdNote()?>">Supprimer</a></td>
<?php endforeach ?>
</table>