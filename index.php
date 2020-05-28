<?php

// Demarre une session utilisateur
session_start();

// On requiere le fichier global qui correspond à la base de donnée
require "conf/global.php";

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
    case "delete_user" : deleteUser();
        break;
    case "user" : $view = showUser();
        break;
    case "all_user" : $view = showAllUser();
        break;
    case "delete_alluser" : deleteUser();
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
    case "delete_comment" : deleteComment();
        break;
    case "delete_allcomment" : deleteAllComment();
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
            return ["template" => "home.html", "datas" => $datas];
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
    $datas = [];
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

    return ["template" => "modifuser.php", "datas" => $datas];
}

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

    return ["template" => "alluser.php", "datas" => $datas];
}

// La fonction showUser permet de montrer les commentaires de l'utilisateur dans la page mescours.php
function showComment() {
    $datas = [];
    $comment = new Commentaire();
    $comment->setIdUtilisateur($_SESSION["id"]);
    $datas = [];
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

    return ["template" => "mescours.php", "datas" => $datas];
}

// La fonction showUser permet de montrer tous les commentaires des utilisateurs dans la page allcomments.php
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

// ------------------------------------------------------------------------------------
// Fonctionnalité(s) redirigées :

// La fonction insertUser permet d'inserer un nouvel utilisateur dans la base de données
function insertUser() {
    var_dump($_POST);
    if(preg_match("#^[a-zA-Z0-9]*$#", $_POST['pseudo']) &&
preg_match("#^[a-zA-Z0-9]*$#", $_POST['password'])){
    echo "Le pseudo et le mot de passe sont corrects";
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
}
header('Location:index.php');
}else {
    echo "Le pseudo et le mot de passe sont incorrects";
}
}

// La fonction connectUser permet de connecter un utilisateur grâce la base de données
function connectUser() {
    if(!empty($_POST['pseudo'] && !empty($_POST['password']))){
        $user = new Utilisateurs();
        $user-> setPseudo($_POST['pseudo']);
        $user-> setPassword($_POST['password']);
        $reponse = $user->selectByPseudo();
        if ($reponse && password_verify($_POST['password'],$reponse['password'])){
            $_SESSION['id'] = $reponse['id_user'];
            $_SESSION['role']= $reponse['role'];
            $_SESSION['pseudo']= $reponse['pseudo'];
            $_SESSION['password']=$reponse['password'];
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
    var_dump($user);
    header('Location:index.php?route=user');
}

// La fonction deleteUser permet de supprimer un utilisateur dans la base de données
function deleteUser(){
    $user = new Utilisateurs();
    $user-> setIdUtilisateur($_SESSION["id"]);
    $user->delete();
    header('Location:index.php?route=user');
}

// La fonction deconnectUser permet de deconnecter un utilisateur et de le renvoyer sur la page d'accueil
function deconnectUser() {
    unset($_SESSION['pseudo']);
    header('Location:index.php');
        }

// La fonction insertComment permet d'inserer un nouveau commentaire dans la base de données
function insertComment() {
    var_dump($_SESSION);
    if(!empty($_POST['description'])){
        $comment = new Commentaire();
        $comment-> setIdUtilisateur($_SESSION['id']);
        $comment-> setDescription($_POST['description']);
        $comment->insert();
        var_dump($comment);
    } 
    header('Location:index.php?route=comment');
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

// La fonction deleteComment permet de supprimer un commentaire dans la base de données
function deleteComment(){
    $comment = new Commentaire();
    $comment-> setIdComment($_REQUEST["id"]);
    var_dump($comment);
    $comment->delete();
    var_dump($comment);
    header('Location:index.php?route=comment');
}

// La fonction deleteComment permet de supprimer tous les commentaires 
function deleteAllComment(){
    $comment = new Commentaire();
    $comment-> setIdComment($_REQUEST["id"]);
    var_dump($comment);
    $comment->delete();
    var_dump($comment);
    header('Location:index.php?route=all_comment');
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
    <link rel="stylesheet" type="text/css" href="css\style.css">
    <title>La Plateforme</title>
</head>
<body>
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