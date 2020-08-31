<?php
$note = $view["datas"]["notes"];
?>

<!-- Vue qui permet d'afficher tous les commentaires de l'utilisateur de les modifier et de les supprimer -->

<h2>Mes Notes </h2>
<table>
<?php foreach ($note as $notation) : ?>
<tr>
<th>Note</th>
<th>Coefficient</th>
<th>Matière</th>
<th>Supression</th>
</tr>
<tr>
<td><a href="index.php?route=notes&id=<?= $notation->getIdNote()?>"><?= $notation->getNote()?></a></td>
<td><a href="index.php?route=notes&id=<?= $notation->getIdNote()?>"><?= $notation->getCoeff()?></a></td>
<td><a href="index.php?route=notes&id=<?= $notation->getIdNote()?>"><?= $notation->getMatiere()?></a></td>
<td><a href="index.php?route=delete_note&id=<?= $notation->getIdNote()?>">Supprimer</a></td>
<?php endforeach ?>
</table>
