<?php

// On requiert le fichier utilisateurs.php pour permettre d'ajouter les informations utilisateurs à nos taches
require 'Utilisateurs.php';

// La classe instancie une nouvelle tache. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base
class Commentaire extends Dbconnect {
    public $idComment;
    public $description;
    public $idUtilisateur;
// Le construct permet d'établir une structure de notre tache
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

    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }

    public function getIdComment() {
        return $this->idComment;
    }

    public function setIdComment(int $id2) {
        $this->idComment = $id2;
    }

   // Permet d'inserer une tache dans la base de donnée. 
    public function insert(){
        $query = "INSERT INTO comments (DESCRIPTION, ID_USER) VALUES (:description, :id)";
        $result = $this->pdo->prepare($query);
        $result->bindValue("description", $this->description, PDO::PARAM_STR);
        $result->bindValue("id", $this->idUtilisateur, PDO::PARAM_INT);
        $result->execute();
        $this->idComment = $this->pdo->lastInsertId();
        var_dump($this);
        return $this;
    }

  // Permet de selectionner toutes les taches dans la base de donnée. 
public function selectAll(){
        $query ="SELECT * FROM comments;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas= $result->fetchAll();

        $tab=[];

        foreach($datas as $data) {
            $current = new Commentaire();
            $current->setIdUtilisateur($data['ID_USER']);
            $current->setIdComment($data['ID_COMMENT']);
            $current->setDescription($data['DESCRIPTION']);
            array_push($tab, $current);
            }
            return $tab;

    }

// Permet de selectionner une tache dans la base de donnée. 
public function select(){
    $query2 = "SELECT * FROM comments WHERE ID_COMMENT = ':idcomment';";
    $result2 = $this->pdo->prepare($query2);
    $result2->bindValue(':idcomment',$this->idComment,PDO::PARAM_INT);
    $result2->execute();
    $data2 = $result2->fetch();
            //appel aux setters de l'objet
        return $this;
    }

// Permet de modifier une tache dans la base de donnée. 
    public function update(){
            $query ="UPDATE * FROM comments WHERE ID_COMMENT = ':idcomment';";
            $result = $this->pdo->prepare($query);
            $result->bindValue(':idcomment',$this->idComment,PDO::PARAM_INT);
            $result->execute();
                return $this;
    }

// Permet de supprimer une tache dans la base de donnée. 
    public function delete(){
        $query ="DELETE * FROM comments WHERE ID_COMMENT = ':idcomment';";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idcomment',$this->idComment,PDO::PARAM_INT);
    $result->execute();
        return $this;
    }

}

?>


