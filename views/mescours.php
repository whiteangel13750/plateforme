<?php

$liste="";
foreach ($view["datas"]["comment"] as $comment) {
    $liste.= "<li>". $comment->getDescription()." par ". " ". $comment->user->getPrenom() ." ". $comment->user->getNom() ."(".$comment->user->getRole().")"."</li>";
}
?>

<ul><?php echo $liste ?></ul>;

<h2> Ajout d'un commentaire</h2>
     <form action="index.php?route=insert_comment" method="post">
             <div>
             <label> Commentaires : </label>
             <input type='textarea' id='description' name='description' placeholder="Intitulé de la tache">
             </div>
             <div>
           <input type='submit' id='valider' value='Soumettre'>
           </div>
         </form>
         
         <form action="index.php?route=update_comment" method="post">
         <div>
           <input type='submit' id='modifier' value='Modifier'>
           </div>
         </form>
         
     </div>
