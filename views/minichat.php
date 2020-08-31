
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

echo '<section id=tchat>';
// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
while ($donnees = $reponse->fetch())
{
	echo '<p id="msg">'." [".htmlspecialchars($donnees['date'])."] "."<strong>". htmlspecialchars($donnees['pseudo'])."</strong>"." > ". htmlspecialchars($donnees['message']) . '</p>';
}

$reponse->closeCursor();

echo '</section>';
?>


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