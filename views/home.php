 
 <!-- Vue qui permet d'afficher les formulaires de connexion et d'inscription -->


 <section class="row bg-light">
  <div class="col-6">
    <h3>Inscrivez-vous</h3>
     <form action="index.php?route=insert_user" method="post">
            <div>
            <label> Je suis un : </label>
           <select name='role' id='role'>
               <option value="Enfant"> Enfant</option>
               <option value="Professeur"> Professeur</option>
               <option value="Parent"> Parent</option>
           </select>
            </div>
            <div>
            <label> Nom</label>
            <input type='text' id='nom' name='nom' placeholder="Votre nom">
            </div>
            <div>
            <label> Prenom</label>
            <input type='text' id='prenom' name='prenom' placeholder="Votre prenom">
            </div>
             <div>
             <label> Pseudo </label>
             <input type='text' id='pseudo' name='pseudo' placeholder="Votre pseudo">
             </div>
             <div>
             <label> Mot de Passe </label>
             <input type='password' id='password' name='password' placeholder="Votre mot de passe" required='required'>
             </div>
             <div>
                <label> Adresse Mail</label>
                <input type='text' id='adresse' name='adresse' placeholder="Votre adresse e-mail" required='required'>
              </div>
             <div>
           <input type='submit' id='valider' value='Soumettre'>
           </div>
         </form>
     </div>
    </section>



<section class="row bg-light">

  <div class="col-6">
    <h3>Se connecter</h3>
    <?php $token=mkToken(uniqid());
     $_SESSION['token']=$token;?>
     <form action="index.php?route=connect_user" method="post">
        <div>
        <label> Pseudo </label>
        <input type='text' id='pseudo1' name='pseudo' placeholder="Votre pseudo">
        </div>
        <div>
        <label> Mot de Passe </label>
        <input type='password' id='password1' name='password' placeholder="Votre mot de passe" required='required'>
        </div>
      <input type='hidden' name='token' value='<?=$token?>'>
        <div>
      <input type='submit' id='connexion' value='Connexion'>
      </div>
    </form>
  </div>
</section>