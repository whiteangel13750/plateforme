
<?php
$tchat = $view["datas"]["tchat"];
$user = $view["datas"]["user"];
?>

<section id=tchat>
<!-- Affichage de chaque message (toutes les données sont protégées par htmlspecialchars) -->

<?php

foreach ($tchat as $tcha) {

    if($tcha->getPseudo()==$_SESSION['pseudo']){
    echo '<p>'
    ."<div id=pseudo3>"." [".$tcha->getDate()."] ". $tcha->getPseudo().
    "</div>".
    "<div id=msg>". $tcha->getMessage() . "</div>". 
    '</p>';
    } else {
         echo '<p>'
         ."<div id=pseudo4>"." [".$tcha->getDate()."] ". $tcha->getPseudo().
         "</div>".
         "<div id=msg2>". $tcha->getMessage() . "</div>". 
         '</p>';  
     }
}
?>


</section>
<div class="col-6">
<form action="index.php?route=<?=isset($view['datas']['tcha'])? "update_tchat" : "insert_tchat"; ?>" method="post">
        <p>
        <input type="text" name="message" id="message" placeholder='Veuillez saisir votre message'><?=isset($view['datas']['tcha'])? $view['datas']['tcha']->getMessage() : ""; ?>
        <?=isset($view['datas']['tcha'])? "<input type='hidden' name='idMini' value=".$view['datas']['tcha']->getIdMini()."'>" : ""; ?>
        <input type="submit" value='<?=isset($view['datas']['tcha'])? "Modifier" : "Ajouter"; ?>'><input type="button" onclick='window.location.reload(false)' value="Rafraichir"/>
	</p>
    </form>
</div>
    </body>
</html>