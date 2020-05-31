<!-- Page qui permet de sécuriser la modification des id par l'utilisateur -->

<?php define('SALT','fpfpdnefbruiufoizhreuofbzorfziohfro');
function mkToken($value) {
    return sha1($value.SALT);
}

$token=mkToken($_SESSION['id']);$_SESSION['token']=$token;


function chkTokenFromSalt($value){
    return(isset($_SESSION['token'])&&$_SESSION['token']==makeToken($_REQUEST[$value]));
}

$token=sha1(uniqid());
$_SESSION['token']=$token;
?>