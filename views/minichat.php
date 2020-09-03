
<?php
// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=plateforme', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Récupération des 10 derniers messages
$reponse = $bdd->query('SELECT pseudo, message, date FROM minichat ORDER BY id DESC LIMIT 0, 10');

?>

<section id=tchat>
<!-- Affichage de chaque message (toutes les données sont protégées par htmlspecialchars) -->

<?php
while ($donnees = $reponse->fetch())
{
    if($donnees['pseudo']==$_SESSION['pseudo']){
    echo '<p>'
    ."<div id=pseudo3>"." [".htmlspecialchars($donnees['date'])."] ". htmlspecialchars($donnees['pseudo']).
    "</div>".
    "<div id=msg>". htmlspecialchars($donnees['message']) . "</div>". 
    '</p>';
    } else {
        echo '<p>'
        ."<div id=pseudo4>"." [".htmlspecialchars($donnees['date'])."] ". htmlspecialchars($donnees['pseudo']).
        "</div>".
        "<div id=msg2>". htmlspecialchars($donnees['message']) . "</div>". 
        '</p>';  
    }
}
$reponse->closeCursor();
?>


</section>
<div class="col-6">
<form action="index.php?route=insert_tchat" method="post">
        <p>
        <input type="text" name="message" id="message" placeholder='Veuillez saisir votre message'> 
        <input type="submit" value="Envoyer"><input type="button" onclick='window.location.reload(false)' value="Rafraichir"/>
	</p>
    </form>
</div>
    </body>
</html>