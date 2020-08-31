<?php
$comm = $view["datas"]["comment"];
?>

<!-- Vue qui permet d'afficher tous les commentaires de l'utilisateur de les modifier et de les supprimer -->


<h2>Mes Commentaires </h2>
<?php foreach ($comm as $comment) : ?>
<a href="index.php?route=comment&id=<?= $comment->getIdComment()?>"><li><?= $comment->getDescription()?>  </a><a href="index.php?route=delete_comment&id=<?= $comment->getIdComment()?>">Supprimer</a></li>;
<?php endforeach ?>
