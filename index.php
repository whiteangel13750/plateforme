<?php

// Demarre une session utilisateur
session_start();

// On requiere le fichier global qui correspond à la base de donnée
require "conf/global.php";

//require "conf/securite.php";

// FRONT CONTROLLER -> Toutes les requêtes arrivent ici et sont traitées par le ROUTER
// ------------------------------------------------------------------------------------
// 1. INCLUSIONS CLASSES
// Dans un premier temps, nous allons inclure les fichiers de nos classes ici pour pouvoir les utiliser

spl_autoload_register(function ($class) {
    if(file_exists("models/$class.php")){
        require_once "models/$class.php";
    }
});

// ------------------------------------------------------------------------------------
// 2. ROUTER
// Structure permettant d'appeler une action en fonction de la requête utilisateur

$route = isset($_REQUEST["route"])? $_REQUEST["route"] : "home";

switch($route) {
    case "home" : $view = showHome();
        break;
    case "insert_user" : insertUser();
        break;
    case "connect_user" : connectUser();
        break;
    case "update_user" : updateUser();
        break;
    case "update_alluser" : updateAllUser();
        break;  
    case "delete_user" : deleteUser();
        break;
    case "user" : $view = showUser();
        break;
    case "all_user" : $view = showAllUser();
        break;
    case "delete_alluser" : deleteAllUser();
        break;
    case "membre" : $view = showMembre();
        break;
    case 'insert_comment' : $view=insertComment();
        break;
    case "comment" : $view = showComment();
        break;
    case "all_comment" : $view = showAllComment();
        break;
    case "update_comment" : updateComment();
        break;
    case "update_allcomment" : updateAllComment();
        break; 
    case "delete_comment" : deleteComment();
        break;
    case "delete_allcomment" : deleteAllComment();
        break;
    case 'insert_cours' : $view=insertCours();
        break;
    case "cours" : $view = showCours();
        break;
    case "all_cours" : $view = showAllCours();
        break;
    case "update_cours" : updateCours();
        break; 
    case "delete_cours" : deleteCours();
        break;
    case "calendrier" : $view = showCalendrier();
        break;
    case "notes" : $view = showNotes();
        break;
    case "all_notes" : $view = showAllNotes();
        break;   
    case 'insert_note' : $view=insertNote();
        break;
    case 'insert_allnote' : $view=insertAllNote();
        break;
    case "update_note" : updateNote();
        break;
    case "update_allnote" : updateAllNote();
        break; 
    case "delete_note" : deleteNote();
        break;
    case "delete_allnote" : deleteAllNote();
        break;   
    case "tchat" : $view = showTchat();
        break;
    case "insert_tchat" : insertTchat();
        break;
    case "deconnect" : deconnectUser();
        break;
    default : $view= showHome();
}

// ------------------------------------------------------------------------------------
// 3. FONCTIONS DE CONTROLE
// Actions déclenchées en fonction du choix de l'utilisateur
// 1 choix = 1 fonction avec deux "types" de fonctions, celles qui mèneront à un affichage, et celles qui seront redirigées (vers un choix conduisant à un affichage)

// La fonction showHome permet d'afficher la page d'accueil. Si jamais l'utilisateur est connecté, il se trouve sur la page membre
function showHome() {
            if(isset($_SESSION["utilisateur"])) {
                header("Location:index.php?route=membre");
            }       
            $datas = [];
            return ["template" => "home.php", "datas" => $datas];
}

// La fonction showCalendrier permet à l'utilisateur d'afficher le calendrier
function showCalendrier() {

    if (!isset($_GET["month"]) && !isset($_GET["year"])) {
    $_GET["month"] = date("m");
    $_GET["year"] = date("y");
    $datas = new Month($_GET["month"], $_GET["year"]);
} else {
    $num = $_GET["month"];
    $year = $_GET["year"];
    $datas = new Month($num, $year);
    }

    return ["template" => "calendrier.php", "datas" => $datas];
} 

// La fonction showMembre permet à l'utilisateur de se retrouver sur la page membre une fois connecté
function showMembre() {

    $datas = [];
    return ["template" => "monespace.php", "datas" => $datas];
}

// La fonction showUser permet de montrer les données de l'utilisateur dans les champs de la page modifuser.php
function showUser() {
    $datas = [];
    $user = new Utilisateurs();
    $user->setIdUtilisateur($_SESSION["id"]);
    $datas["user"]= $user->select();
    
    if(isset($_GET['id'])) {
        $user->setIdUtilisateur($_GET['id']);
        $use = $user->select();
        $datas["user"]=$use;
    }

    foreach($datas["user"] as &$us){
        $utilisateur = new Utilisateurs();
        $utilisateur->setIdUtilisateur($us->getIdUtilisateur());
        $user= $utilisateur->select();
        $us->user = $user;
    }

    foreach($datas["user"] as &$com){
        $com->setPseudo(htmlspecialchars($com->getPseudo()));
        $com->setPassword(htmlspecialchars($com->getPassword()));
        $com->setNom(htmlspecialchars($com->getNom()));
        $com->setPrenom(htmlspecialchars($com->getPrenom()));
        $com->setAdresse(htmlspecialchars($com->getAdresse()));
    }

    return ["template" => "modifuser.php", "datas" => $datas];
}

// La fonction showAllUser permet de montrer les commentaires de l'utilisateur dans la page alluser.php
function showAllUser() {
    $datas = [];
    $user = new Utilisateurs();
    $user->setIdUtilisateur($_SESSION["id"]);
    $datas["users"]= $user->selectAll();
    
    if(isset($_GET['id'])) {
        $user->setIdUtilisateur($_GET['id']);
        $use = $user->select();
        $datas["user"]=$use;
    }

    foreach($datas["users"] as &$com){
        $com->setPseudo(htmlspecialchars($com->getPseudo()));
        $com->setPassword(htmlspecialchars($com->getPassword()));
        $com->setNom(htmlspecialchars($com->getNom()));
        $com->setPrenom(htmlspecialchars($com->getPrenom()));
        $com->setAdresse(htmlspecialchars($com->getAdresse()));
    }

    return ["template" => "alluser.php", "datas" => $datas];
}

// La fonction showComment permet de montrer les commentaires de l'utilisateur dans la page mescours.php
function showComment() {
    $datas = [];
    $comment = new Commentaire();
    $comment->setIdUtilisateur($_SESSION["id"]);
    $datas["comment"]= $comment->selectByUser();
    if(isset($_GET['id'])) {
        $comment->setIdComment($_GET['id']);
        $commentaire = $comment->select();
        $datas["com"]=$commentaire;
    }

    foreach($datas["comment"] as &$com){
        $utilisateur = new Utilisateurs();
        $utilisateur->setIdUtilisateur($com->getIdUtilisateur());
        $user= $utilisateur->select();
        $com->user = $user;
    }

    foreach($datas["comment"] as &$com){
        $com->setdescription(htmlspecialchars($com->getdescription()));
    }
    
    return ["template" => "comment.php", "datas" => $datas];
}

// La fonction showAllComment permet de montrer tous les commentaires des utilisateurs dans la page allcomments.php
function showAllComment() {
    $datas = [];
    $comment = new Commentaire();
    $comment->setIdUtilisateur($_SESSION["id"]);
    $datas["comment"]= $comment->selectAll();

 


    if(isset($_GET['id'])) {
        $comment->setIdComment($_GET['id']);
        $commentaire = $comment->select();
        $datas["com"]=$commentaire;
          
    }

    foreach($datas["comment"] as &$com){
        $utilisateur = new Utilisateurs();
        $utilisateur->setIdUtilisateur($com->getIdUtilisateur());
        $user= $utilisateur->select();
        $com->user = $user;
    }

    foreach($datas["comment"] as &$com){
        $com->setdescription(htmlspecialchars($com->getdescription()));
    }

    return ["template" => "allcomments.php", "datas" => $datas];
}

//La fonction showCours permet de montrer les cours de l'utilisateur dans la page cours.php
function showCours() {
    $datas = [];
    $cours = new Cours();
    $cours->setIdUtilisateur($_SESSION["id"]);
    $datas["cours"]= $cours->selectByUser();
    if(isset($_GET['id'])) {
        $cours->setIdCours($_GET['id']);
        $cours1 = $cours->select();
        $datas["cou"]=$cours1;
    }

    foreach($datas["cours"] as &$cou){
        $utilisateur = new Utilisateurs();
        $utilisateur->setIdUtilisateur($cou->getIdUtilisateur());
        $user= $utilisateur->select();
        $cou->user = $user;
    }

    foreach($datas["cours"] as &$cou){

        $cou->setTitre(htmlspecialchars($cou->getTitre()));
        $cou->setImage(htmlspecialchars($cou->getImage()));
        $cou->setContenu(htmlspecialchars($cou->getContenu()));
    }

    $matiere = new Matiere();
    $datas["matiere"]= $matiere->selectAll();


    return ["template" => "cours.php", "datas" => $datas];
}

//La fonction showAllCours permet de montrer tous les cours des utilisateurs dans la page allcours.php

function showAllCours() {
    $datas = [];
    $cours = new Cours();
    $cours->setIdUtilisateur($_SESSION["id"]);
    $datas = [];
    $datas["cours"]= $cours->selectAll();
    if(isset($_GET['id'])) {
        $cours->setIdCours($_GET['id']);
        $cours1 = $cours->select();
        $datas["cou"]=$cours1;
    }

    foreach($datas["cours"] as &$cou){
        $utilisateur = new Utilisateurs();
        $utilisateur->setIdUtilisateur($cou->getIdUtilisateur());
        $user= $utilisateur->select();
        $cou->user = $user;
    }

    foreach($datas["cours"] as &$cou){

        $cou->setTitre(htmlspecialchars($cou->getTitre()));
        $cou->setImage(htmlspecialchars($cou->getImage()));
        $cou->setContenu(htmlspecialchars($cou->getContenu()));
    }

    $comment = new Commentaire();
    $comment->setIdUtilisateur($_SESSION["id"]);
    $datas["comment"]= $comment->selectAll();

    if(isset($_GET['idComment'])) {
        $comment->setIdComment($_GET['idComment']);
        $commentaire = $comment->select();
        $datas["com"]=$commentaire;
          
    }

    foreach($datas["comment"] as &$com){
        $utilisateur = new Utilisateurs();
        $utilisateur->setIdUtilisateur($com->getIdUtilisateur());
        $user= $utilisateur->select();
        $com->user = $user;
    }

    foreach($datas["comment"] as &$com){
        $com->setdescription(htmlspecialchars($com->getdescription()));
    }

    $matiere = new Matiere();
    $datas["matiere"]= $matiere->selectAll();


    return ["template" => "allcours.php", "datas" => $datas];
}

function showNotes() {
    $datas = [];
    $notes = new Notes();
    $notes->setIdProfesseur($_SESSION["id"]);
    $datas["notes"]= $notes->selectByIdProfesseur();
    
    if(isset($_GET['id'])) {
        $notes->setIdNote($_GET['id']);
        $notes1 = $notes->select();
        $datas["not"]=$notes1;
    }

    foreach($datas["notes"] as &$not){
        $utilisateur = new Utilisateurs();
        $utilisateur->setIdUtilisateur($not->getIdUtilisateur());
        $user= $utilisateur->select();
        $not->user = $user;
    }

    foreach($datas["notes"] as &$not){

        $not->setNote(htmlspecialchars($not->getNote()));
        $not->setMatiere(htmlspecialchars($not->getMatiere()));
        $not->setCoeff(htmlspecialchars($not->getCoeff()));
    }

   
    return ["template" => "notes.php", "datas" => $datas];
}

function showAllNotes() {
    
    $datas = [];

    // CAS 1 : Insertion
    // $datas['notes'] -> Toutes les notes du professeur
    $notes = new Notes();
    $notes->setIdProfesseur($_SESSION["id"]);
    $datas["notes"]= $notes->selectByIdProfesseur();

    foreach ($datas["notes"] as &$note) {
        $eleve = new Utilisateurs();
        $eleve->setIdUtilisateur($note->getIdEleve());
        $eleve->select();

        $matiere = new Matiere();
        $matiere->setIdMatiere($note->getIdMatiere());
        $matiere->select();

        $note->eleve = $eleve->getNom()." ".$eleve->getPrenom();
        $note->matiere = $matiere->getMatiere();
    }

    // $datas['eleves'] -> Tous les élèves (pour select)
    $eleve = new Utilisateurs();
    $eleve->setRole("Enfant");
    $datas["eleves"] = $eleve->selectByRole();

    // $datas['matieres'] -> Toutes les matieres (pour select)
    $matiere = new Matiere();
    $datas["matieres"] = $matiere->selectAll();

    // CAS 2 : Mise à jour
    // $datas['note'] -> La note à mettre à jour
    if(isset($_GET["id"])) {
        $note = new Notes();
        $note->setIdNote($_GET['id']);
        $datas["note"] = $note->select();

        $eleve = new Utilisateurs();
        $eleve->setIdUtilisateur($note->getIdEleve());
        $eleve->select();
        $datas["note"]->eleve = $eleve->getNom()." ".$eleve->getPrenom();

        $matiere = new Matiere();
        $matiere->setIdMatiere($note->getIdMatiere());
        $matiere->select();
        $datas["note"]->matiere = $matiere->getMatiere();
    }
    
    var_dump($datas);
    return ["template" => "allnotes.php", "datas" => $datas];
};

function showTchat() {

    $datas = [];
    $tchat = new Minitchat();
    $tchat->setIdutilisateur($_SESSION["id"]);
    $datas["tchat"]= $tchat->selectAll();
    
    if(isset($_GET['id'])) {
        $tchat->setIdMini($_GET['id']);
        $tcha = $tchat->select();
        $datas["tcha"]=$tcha;
    }

    foreach($datas["tchat"] as &$tc){
        $utilisateur = new Utilisateurs();
        $utilisateur->setIdUtilisateur($tc->getIdUtilisateur());
        $user= $utilisateur->select();
        $tc->user = $user;
    }
    
    $user = new Utilisateurs();
    $user->setIdUtilisateur($_SESSION["id"]);
    $datas["user"]= $user->selectAll();
    
    if(isset($_GET['id'])) {
        $user->setIdUtilisateur($_GET['id']);
        $use = $user->select();
        $datas["user"]=$use;
    }

    foreach($datas["user"] as &$com){
        $com->setPseudo(htmlspecialchars($com->getPseudo()));
        $com->setPassword(htmlspecialchars($com->getPassword()));
        $com->setNom(htmlspecialchars($com->getNom()));
        $com->setPrenom(htmlspecialchars($com->getPrenom()));
        $com->setAdresse(htmlspecialchars($com->getAdresse()));
    }

    foreach($datas["tchat"] as &$tch){
        $tch->setPseudo(htmlspecialchars($tch->getPseudo()));
        $tch->setMessage(htmlspecialchars($tch->getMessage()));
        $tch->setDate(htmlspecialchars($tch->getDate()));
    }

    return ["template" => "minichat.php", "datas" => $datas];
}

// Fonctionnalité(s) redirigées :

// La fonction insertUser permet d'inserer un nouvel utilisateur dans la base de données
function insertUser() {
    var_dump($_POST);
    if(preg_match("#^[a-zA-Z0-9ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØŒŠþÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøœšÞùúûüýÿ]*$#", $_POST['pseudo']) &&
preg_match("#^[a-zA-Z0-9ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØŒŠþÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøœšÞùúûüýÿ.,?&@;]*$#", $_POST['password'])){
    if(!empty($_POST['role'] && !empty($_POST['nom'] && !empty($_POST['prenom'] && !empty($_POST['adresse'] && !empty($_POST['pseudo'] && !empty($_POST['password']))))))){
$user = new Utilisateurs();
$user-> setRole($_POST['role']);
$user-> setNom($_POST['nom']);
$user-> setPrenom($_POST['prenom']);
$user-> setAdresse($_POST['adresse']);
$user-> setPseudo($_POST['pseudo']);
$user-> setPassword(password_hash($_POST['password'], PASSWORD_DEFAULT));
$reponse = $user->selectByPseudo();
var_dump($user);
        $user->insert();
        $role= isset($_POST['role'])? $_POST['role'] : "null";
        $nom= isset($_POST['nom'])? $_POST['nom'] : "null";
        $prenom= isset($_POST['prenom'])? $_POST['prenom'] : "null";
        $adresse= isset($_POST['adresse'])? $_POST['adresse'] : "null";
        $pseudo= isset($_POST['pseudo'])? $_POST['pseudo'] : "null";
        $password= isset($_POST['password'])? $_POST['password'] : "null";
        $_SESSION['pseudo']=$pseudo;
        $_SESSION['password']=$password;        
        $_SESSION["nom"]=$nom;
        $_SESSION["prenom"]=$prenom;
}
header('Location:index.php');
}else {
    header('Location:index.php');

}
}

// La fonction connectUser permet de connecter un utilisateur grâce la base de données
function connectUser() {
    if(preg_match("#^[a-zA-Z0-9ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØŒŠþÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøœšÞùúûüýÿ]*$#", $_POST['pseudo']) &&
preg_match("#^[a-zA-Z0-9ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØŒŠþÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøœšÞùúûüýÿ.,?&@;]*$#", $_POST['password'])){
            if(!empty($_POST['pseudo'] && !empty($_POST['password']))){
                $user = new Utilisateurs();
                $user-> setPseudo($_POST['pseudo']);
                $user-> setPassword($_POST['password']);
                $reponse = $user->selectByPseudo();
                                    if ($reponse && password_verify($_POST['password'],$reponse['password'])&& isset($_SESSION['token'])&& $_SESSION['token']==$_POST['token']){
                                        $_SESSION['id'] = $reponse['id_user'];
                                        $_SESSION['role']= $reponse['role'];
                                        $_SESSION['pseudo']= $reponse['pseudo'];
                                        $_SESSION['password']=$reponse['password'];
                                        $_SESSION['nom']= $reponse['nom'];
                                        $_SESSION['prenom']=$reponse['prenom'];
                                        header('Location:index.php?route=membre');
                                    }
                                    header('Location:index.php?route=membre');
                    }else {
                        header('Location:index.php');
                    }
                }
            }
                    

// La fonction updateUser permet de modifier un utilisateur dans la base de données
function updateUser(){
    $user = new Utilisateurs();
    $user-> setIdUtilisateur($_SESSION['id']);
    $user-> setPseudo($_POST['pseudo']);
    $user-> setNom($_POST['nom']);
    $user-> setPrenom($_POST['prenom']);
    $user-> setAdresse($_POST['adresse']);
    $user->update();
    header('Location:index.php?route=user');
}

// La fonction updateUser permet de modifier un utilisateur dans la base de données
function updateAllUser(){
    $user = new Utilisateurs();
    $user-> setIdUtilisateur($_SESSION['id']);
    $user-> setPseudo($_POST['pseudo']);
    $user-> setNom($_POST['nom']);
    $user-> setPrenom($_POST['prenom']);
    $user-> setAdresse($_POST['adresse']);
    $user->update();
    header('Location:index.php?route=all_user');
}

// La fonction deleteUser permet de supprimer un utilisateur dans la base de données
function deleteUser(){
    $user = new Utilisateurs();
    $user-> setIdUtilisateur($_SESSION["id"]);
    $user->delete();
    header('Location:index.php');
}

// La fonction deleteAllUser permet de supprimer un utilisateur dans la base de données
function deleteAllUser(){
    $user = new Utilisateurs();
    $user-> setIdUtilisateur($_REQUEST["id"]);
    $user->delete();
    header('Location:index.php?route=all_user');
}

// La fonction deconnectUser permet de deconnecter un utilisateur et de le renvoyer sur la page d'accueil
function deconnectUser() {
session_start();
session_destroy();
    header('Location:index.php');
        }

// La fonction insertComment permet d'inserer un nouveau commentaire dans la base de données
function insertComment() {
    if(preg_match("#^[a-zA-Z0-9ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØŒŠþÙÚÛÜÝŸàáâãäåæçèéêëìíîïðñòóôõöøœšÞùúûüýÿ' /]*$#", $_POST['description'])){
    if(!empty($_POST['description'])){
        $comment = new Commentaire();
        $comment-> setIdUtilisateur($_SESSION['id']);
        $comment-> setDescription($_POST['description']);
        $comment->insert();
        var_dump($comment);
    } 
    header('Location:index.php?route=all_cours');
    } else {
        header('Location:index.php?route=all_cours');
    }
}

// La fonction updateComment permet de modifier un commentaire dans la base de données
function updateComment(){
    $comment = new Commentaire();
    $comment-> setIdComment($_POST["idComment"]);
    $comment-> setIdUtilisateur($_SESSION['id']);
    $comment-> setDescription($_POST['description']);
    $comment->update();
    var_dump($comment);
    header('Location:index.php?route=comment');
}

// La fonction updateComment permet de modifier un commentaire dans la base de données
function updateAllComment(){
    $comment = new Commentaire();
    $comment-> setIdComment($_POST["idComment"]);
    $comment-> setIdUtilisateur($_SESSION['id']);
    $comment-> setDescription($_POST['description']);
    $comment->update();
    var_dump($comment);
    header('Location:index.php?route=all_comment');
}

// La fonction deleteComment permet de supprimer un commentaire dans la base de données
function deleteComment(){
    $comment = new Commentaire();
    $comment-> setIdComment($_REQUEST["id"]);
    var_dump($comment);
    $comment->delete();
    var_dump($comment);
    header('Location:index.php?route=comment');
}

// La fonction deleteAllComment permet de supprimer tous les commentaires 
function deleteAllComment(){
    $comment = new Commentaire();
    $comment-> setIdComment($_REQUEST["id"]);
    var_dump($comment);
    $comment->delete();
    var_dump($comment);
    header('Location:index.php?route=all_comment');
}

// La fonction insertCours permet d'inserer un nouveau cours dans la base de données
function insertCours() {
    if(!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['image'])){
        $cours = new Cours();
        $cours-> setIdUtilisateur($_SESSION['id']);
        $cours-> setTitre($_POST['titre']);
        $cours-> setContenu($_POST['contenu']);
        $cours-> setImage($_POST['image']);
        $cours-> setIdMatiere($_POST['idmatiere']);
        $cours->insert();

    } 
    var_dump($_POST);
    var_dump($cours);
    // header('Location:index.php?route=cours');
}

// La fonction updateCours permet de modifier un cours dans la base de données
function updateCours(){
    $cours = new Cours();
    $cours-> setIdCours($_POST["idCours"]);
    $cours-> setIdUtilisateur($_SESSION['id']);
    $cours-> setTitre($_POST['titre']);
    $cours-> setIdMatiere($_POST['idmatiere']);
    $cours-> setContenu($_POST['contenu']);
    $cours-> setImage($_POST['image']);
    $cours->update();
    var_dump($cours);
    header('Location:index.php?route=cours');

}

// La fonction deleteCours permet de supprimer un cours dans la base de données
function deleteCours(){
    $cours = new Cours();
    $cours-> setIdCours($_REQUEST["id"]);
    var_dump($cours);
    $cours->delete();
    var_dump($cours);
    header('Location:index.php?route=cours');
}

// La fonction insertCours permet d'inserer un nouveau cours dans la base de données
function insertNote() {
        $note = new Notes();
        $note-> setIdProfesseur($_SESSION['id']);
        $note-> setIdEleve($_POST['ideleve']);
        $note-> setNote($_POST['note']);
        $note-> setIdMatiere($_POST['idmatiere']);
        $note-> setCoeff($_POST['coeff']);
        $note->insert();
        var_dump($note);
    header('Location:index.php?route=notes');
}

// La fonction updateCours permet de modifier un cours dans la base de données
function updateNote(){
    $note = new Notes();
    $note-> setIdProfesseur($_SESSION['id']);
    $note-> setIdEleve($_POST['ideleve']);
    $note-> setNote($_POST['note']);
    $note-> setIdNote($_POST['idnote']);
    $note-> setIdMatiere($_POST['idmatiere']);
    $note-> setCoeff($_POST['coeff']);
    $note->update();
    var_dump($note);
    header('Location:index.php?route=notes');

}

// La fonction updateCours permet de modifier un cours dans la base de données
function updateAllNote(){

    var_dump($_POST);
    $note = new Notes();
    $note-> setIdProfesseur($_SESSION['id']);
    $note-> setIdEleve($_POST['ideleve']);
    $note-> setNote($_POST['note']);
    $note-> setIdNote($_POST['idNote']);
    $note-> setIdMatiere($_POST['idmatiere']);
    $note-> setCoeff($_POST['coeff']);
    $note->update();
    var_dump($note);
    header('Location:index.php?route=all_notes');

}

// La fonction deleteCours permet de supprimer un cours dans la base de données
function deleteNote(){
    $note = new Notes();
    $note-> setIdNote($_REQUEST["id"]);
    var_dump($note);
    $note->delete();
    var_dump($note);
    header('Location:index.php?route=notes');
}

function insertAllNote() {
    $note = new Notes();
    $note-> setIdProfesseur($_SESSION['id']);
    $note-> setIdEleve($_POST['ideleve']);
    $note-> setNote($_POST['note']);
    $note-> setIdMatiere($_POST['idmatiere']);
    $note-> setCoeff($_POST['coeff']);
    $note->insert();
    var_dump($note);
header('Location:index.php?route=all_notes');
}

function deleteAllNote(){
    $note = new Notes();
    $note-> setIdNote($_REQUEST["id"]);
    var_dump($note);
    $note->delete();
    var_dump($note);
    header('Location:index.php?route=all_notes');
}

function insertTchat(){
    $tchat = new Minitchat();
    var_dump($_SESSION);
    $tchat-> setIdUtilisateur($_SESSION["id"]);
    $tchat-> setPseudo($_SESSION['pseudo']);
    $tchat-> setMessage($_POST['message']);
    $tchat->insert();
    var_dump($tchat);
header('Location:index.php?route=tchat');
}

// ------------------------------------------------------------------------------------
// 4. TEMPLATE
// Affichage du système de templates HTML  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="css/app.css"> -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>La Plateforme</title>
</head>
<body>
<?php require "html/nav.php"?>

    <?php require "views/{$view['template']}";?>
 
<!-- Version non compilé de Javascript pour Foundation -->
<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="node_modules/what-input/dist/what-input.js"></script>
<script src="node_modules/foundation-sites/dist/js/foundation.js"></script>
<script src="js/app.js"></script>

<!-- Compressed CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">

<!-- Compressed JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js" integrity="sha256-pRF3zifJRA9jXGv++b06qwtSqX1byFQOLjqa2PTEb2o=" crossorigin="anonymous"></script>

</body>
</html> 