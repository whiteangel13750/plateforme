<?php

// On requiert le fichier utilisateurs.php pour permettre d'ajouter les informations utilisateurs à nos taches
require 'Utilisateurs.php';

// La classe instancie une nouvelle cours. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base
class Notes extends Dbconnect {
    public $idNote;
    public $eleve;
    public $note;
    public $coeff;
    public $matiere;
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

    public function getEleve() {
        return $this->eleve;
    }
    
    public function setEleve($eleve) {
        $this->eleve = $eleve;
    }

    public function getNote() {
        return $this->note;
    }
    
    public function setNote($note) {
        $this->note = $note;
    }

    public function getCoeff() {
        return $this->coeff;
    }
    
    public function setCoeff($coeff) {
        $this->coeff = $coeff;
    }
    public function getMatiere() {
        return $this->matiere;
    }

    public function setMatiere($matiere) {
        $this->matiere = $matiere;
    }

    public function getIdNote() {
        return $this->idNote;
    }

    public function setIdNote($id2) {
        $this->idNote = $id2;
    }

   // Permet d'inserer un cours dans la base de donnée. 
    public function insert(){
        $query = "INSERT INTO notes (ELEVE, NOTE, MATIERE,COEFF, ID_USER) VALUES (:eleve, :note,  :matiere, :coeff, :id)";
        $result = $this->pdo->prepare($query);
        $result->bindValue("note", $this->note, PDO::PARAM_INT);
        $result->bindValue("coeff", $this->coeff, PDO::PARAM_INT);
        $result->bindValue("eleve", $this->eleve, PDO::PARAM_STR);
        $result->bindValue("matiere", $this->matiere, PDO::PARAM_STR);
        $result->bindValue("id", $this->idUtilisateur, PDO::PARAM_INT);
        $result->execute();
        $this->idNote = $this->pdo->lastInsertId();
        var_dump($this);
        return $this;
    }

  // Permet de selectionner tous les cours dans la base de donnée. 
public function selectAll(){
        $query ="SELECT * FROM notes;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas= $result->fetchAll();

        $tab=[];

        foreach($datas as $data) {
            $current = new Notes();
            $current->setIdUtilisateur($data['ID_USER']);
            $current->setIdNote($data['ID_NOTE']);
            $current->setEleve($data['ELEVE']);
            $current->setNote($data['NOTE']);
            $current->setCoeff($data['COEFF']);
            $current->setMatiere($data['MATIERE']);
            array_push($tab, $current);
            }
            return $tab;

    }
  // Permet de selectionner tous les cours dans la base de donnée. 
  public function selectByUser(){
    $query ="SELECT * FROM notes WHERE ID_USER = :iduser;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':iduser',$this->idUtilisateur,PDO::PARAM_INT);
    $result->execute();
    $datas= $result->fetchAll();

    $tab=[];
    foreach($datas as $data) {
        $current = new Notes();
        $current->setIdUtilisateur($data['ID_USER']);
        $current->setIdNote($data['ID_NOTE']);
        $current->setEleve($data['ELEVE']);
        $current->setNote($data['NOTE']);
        $current->setCoeff($data['COEFF']);
        $current->setMatiere($data['MATIERE']);
        array_push($tab, $current);
        }
        return $tab;

}
// Permet de selectionner un cours dans la base de donnée. 
public function select(){
    $query = "SELECT * FROM notes WHERE ID_NOTE = :idnote;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idnote',$this->idNote,PDO::PARAM_INT);
    $result->execute();
    $data = $result->fetch();
    $this->setIdUtilisateur($data['ID_USER']);
    $this->setIdNote($data['ID_NOTE']);
    $this->setCoeff($data['COEFF']);
    $this->setMatiere($data['MATIERE']);
    $this->setNote($data['NOTE']);
    $this->setEleve($data['ELEVE']);
        return $this;
    }

// Permet de modifier un cours dans la base de donnée. 
    public function update(){
            $query ="UPDATE `notes` SET `NOTE`=:note, `MATIERE`=:matiere,`ID_USER`=:iduser, 'COEFF'=:coeff,`ELEVE`=:ELEVE, WHERE ID_NOTE = :idnote";
            $result = $this->pdo->prepare($query);
            $result->bindValue(':idnote',$this->idNote,PDO::PARAM_INT);
            $result->bindValue(':note',$this->note,PDO::PARAM_INT);
            $result->bindValue(':coeff', $this->coeff, PDO::PARAM_INT);
            $result->bindValue(':matiere',$this->matiere,PDO::PARAM_STR);
            $result->bindValue(':eleve',$this->eleve,PDO::PARAM_STR);
            $result->bindValue(':iduser',$this->idUtilisateur,PDO::PARAM_INT);
            $result->execute();
            var_dump($result);
    }

// Permet de supprimer un cours dans la base de donnée. 
    public function delete(){
        $query ="DELETE FROM `notes` WHERE ID_NOTE = :idnote";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idnote',$this->idNote,PDO::PARAM_INT);
    $result->execute();
    }

}

?>


