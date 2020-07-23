<?php
$user = $view["datas"]["user"];
?>

<!-- Vue qui permet d'afficher l'utilisateur, de les modifier et de les supprimer -->
<?php require "securite.php"?>
<nav>
            <div class="top-bar">
                <div class="top-bar-left">
                  <ul class="dropdown menu" data-dropdown-menu>
                            <li class="menu-text">
                            <li><a href="index.php?route=membre">Accueil</a></li>
                            <li><a href="index.php?route=cours">Mes cours</a></li>
                            <li><a href="index.php?route=calendrier">Agenda</a></li>
                            <li><a href="index.php?route=user">Mon profil</a></li>
                            <?php 
                        if ($_SESSION['role'] == 'Enfant'){
                        require "html/menueleve.html";

                        } else if($_SESSION['role'] == 'Professeur'){
                        require "html/menuprof.html";
                        
                        } else {
                        require "html/menuparent.html";
                        }
                        ?>
                        <li><a href="index.php?route=deconnect">Me deconnecter</a></li>
                    </ul>
                </div>
            </div>
    </nav>

 <h2>Mon Profil</h2>

 
 <section class="row bg-light">
     <div class="col-6">
     <h3>Modification de mes coordonnées</h3>
     <form action="index.php?route=<?=isset($view['datas']['user'])? "update_user" : ""; ?>" method="post">
            <div>
            <label> Nom</label>
            <input type='text' id='nom' name='nom' placeholder="Votre nom"  value="<?=isset($view['datas']['user'])? $view['datas']['user']->getNom() : ""; ?>">
            </div>
            <div>
            <label> Prenom</label>
            <input type='text' id='prenom' name='prenom' placeholder="Votre prenom"  value="<?=isset($view['datas']['user'])? $view['datas']['user']->getPrenom() : ""; ?>">
            </div>
             <div>
             <label> Pseudo </label>
             <input type='text' id='pseudo' name='pseudo' placeholder="Votre pseudo"  value="<?=isset($view['datas']['user'])? $view['datas']['user']->getPseudo() : ""; ?>">
             </div>
             <div>
                <label> Adresse Mail</label>
                <input type='text' id='adresse' name='adresse' placeholder="Votre adresse e-mail" required='required'  value="<?=isset($view['datas']['user'])? $view['datas']['user']->getAdresse() : ""; ?>">
                </div>
             <div>
           <input type='submit' id='valider' value='<?=isset($view['datas']['user'])? "Modifier" : ""; ?>'>
           </div>
         </form>
     </div>
   </section>

<section class="row bg-light">
<h3>Suppression du compte</h3>
<div class="col-6">
<p><button class="button" data-open="suppression">Suppression de votre compte</button></p>
<div class="reveal" id="suppression" data-reveal>
  <p class="lead">Pour supprimer votre compte, il faudra supprimer vos posts. Ensuite, vous pourrez supprimer votre compte.</p>
  <a href="index.php?route=delete_comment"> Supprimer vos commentaires</a><br>
  <?php if ($_SESSION['role']=='Professeur') : ?>
  <a href="index.php?route=delete_cours"> Supprimer vos cours</a><br>
  <?php endif ?>
  <a href="index.php?route=delete_user"> Supprimer votre compte</a>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
    </div>
  </div>
</section>


