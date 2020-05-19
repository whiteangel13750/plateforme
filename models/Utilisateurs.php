<?php

// La classe instancie un nouvel utilisateur. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base
class Utilisateurs extends Dbconnect {
    private $idUtilisateur;
    private $role;
    private $nom;
    private $prenom;
    private $adresse;
    private $pseudo;
    private $password;
 
// Le construct permet d'établir une structure de notre utilisateur
    function __construct($id=null) {
        parent::__construct($id);
    }

// La syntaxe get permet de lier une propriété d'un objet à une fonction qui sera appelée lorsqu'on accédera à la propriété.
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

// La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
    }

    public function getRole($role) {
     return $this->role;
 }
 
 public function setRole($role) {
     $this->role = $role;
 }

 public function getNom($nom) {
     return $this->nom;
 }
 
 public function setNom($nom) {
     $this->nom = $nom;
 }

 public function getPrenom($prenom) {
     return $this->prenom;
 }
 
 public function setPrenom($prenom) {
     $this->prenom = $prenom;
 }

    public function getAdresse($adresse) {
        return $this->adresse;
    }
    
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    
    public function getPseudo($pseudo) {
        return $this->pseudo;
    }
    
    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getPassword($password) {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }


    // Permet d'inserer un utilisateur dans la base de donnée. 

public function insert(){

$query="INSERT INTO users(ROLE, NOM, PRENOM, ADRESSE_EMAIL, PSEUDO, PASSWORD) VALUES (:role, :nom, :prenom,:adresse_mail,:pseudo,:password)";
$result=$this->pdo->prepare($query);
$result->bindValue(':role',$this->role,PDO::PARAM_STR);
$result->bindValue(':nom',$this->nom,PDO::PARAM_STR);
$result->bindValue(':prenom',$this->prenom,PDO::PARAM_STR);
$result->bindValue(':adresse_mail',$this->adresse,PDO::PARAM_STR);
$result->bindValue(':pseudo',$this->pseudo,PDO::PARAM_STR);
$result->bindValue(':password',$this->password,PDO::PARAM_STR);
$result->execute();
$this->id=$this->pdo->lastInsertId();
return$this;
}

  // Permet de selectionner tous les utilisateurs dans la base de donnée. 

public function selectAll(){
        $query ="SELECT * FROM users;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas= $result->fetchAll();

        $tab=[];

        foreach($datas as $data) {
            $current = new Utilisateurs();
            $current->setId($data['id_user']);
            array_push($tab, $current);
            }
            return $tab;

    }

// Permet de selectionner un utilisateurs dans la base de donnée. 
    
public function select(){
    $query2 = "SELECT * FROM users WHERE id_user = $this->idUtilisateur;";
    $result2 = $this->pdo->prepare($query2);
    $result2->execute();
    $data2 = $result2->fetch();
            //appel aux setters de l'objet
        return $this;
    }

    public function selectByPseudo(){
        $query2 = "SELECT * FROM users WHERE pseudo = '$this->pseudo';";
        $result2 = $this->pdo->prepare($query2);
        $result2->execute();
        $data2 = $result2->fetch();
                //appel aux setters de l'objet
         return $data2;
        }

}
?>