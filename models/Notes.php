<?php

// La classe instancie une nouvelle cours. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base
class Notes extends Dbconnect {
    public $idNote;
    public $note;
    public $coeff;
    public $idProfesseur;
    public $idEleve;
    public $idMatiere;
// Le construct permet d'établir une structure de notre tache
    function __construct($id=null) {
     parent::__construct($id);
}

    public function getIdProfesseur() {
        return $this->idProfesseur;
    }
// La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdProfesseur(int $id3) {
        $this->idProfesseur = $id3;
    }

    public function getIdEleve() {
        return $this->idEleve;
    }
// La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdEleve(int $id4) {
        $this->idEleve = $id4;
    }

    public function getIdMatiere() {
        return $this->idMatiere;
    }
// La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdMatiere(int $id5) {
        $this->idMatiere = $id5;
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

    public function getIdNote() {
        return $this->idNote;
    }

    public function setIdNote($id2) {
        $this->idNote = $id2;
    }

   // Permet d'inserer un cours dans la base de donnée. 
    public function insert(){
        $query = "INSERT INTO notes (NOTE,COEFF, ID_ELEVE, ID_PROF, ID_MATIERE) VALUES (:note, :coeff, :ideleve, :idprof, :idmatiere)";
        $result = $this->pdo->prepare($query);
        $result->bindValue("note", $this->note, PDO::PARAM_INT);
        $result->bindValue("coeff", $this->coeff, PDO::PARAM_INT);
        $result->bindValue("idprof", $this->idProfesseur, PDO::PARAM_INT);
        $result->bindValue("ideleve", $this->idEleve, PDO::PARAM_INT);
        $result->bindValue("idmatiere", $this->idMatiere, PDO::PARAM_INT);
        $result->execute();
        $this->idNote= $this->pdo->lastInsertId();
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
            $current->setIdProfesseur($data['ID_PROF']);
            $current->setIdNote($data['ID_NOTE']);
            $current->setIdEleve($data['ID_ELEVE']);
            $current->setNote($data['NOTE']);
            $current->setCoeff($data['COEFF']);
            $current->setIdMatiere($data['ID_MATIERE']);
            array_push($tab, $current);
            }
            return $tab;

    }
  // Permet de selectionner tous les cours dans la base de donnée. 
  public function selectByIdProfesseur(){
    $query ="SELECT * FROM notes WHERE ID_PROF = :idprof;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idprof',$this->idProfesseur,PDO::PARAM_INT);
    $result->execute();
    $datas= $result->fetchAll();

    $tab=[];
    foreach($datas as $data) {
        $current = new Notes();
        $current->setIdProfesseur($data['ID_PROF']);
        $current->setIdNote($data['ID_NOTE']);
        $current->setIdEleve($data['ID_ELEVE']);
        $current->setNote($data['NOTE']);
        $current->setCoeff($data['COEFF']);
        $current->setIdMatiere($data['ID_MATIERE']);
        array_push($tab, $current);
        }
        return $tab;

}

  // Permet de selectionner tous les cours dans la base de donnée. 
  public function selectByIdEleve(){
    $query ="SELECT * FROM notes WHERE ID_ELEVE = :ideleve;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':ideleve',$this->idEleve,PDO::PARAM_INT);
    $result->execute();
    $datas= $result->fetchAll();
    $tab=[];
    foreach($datas as $data) {
        $current = new Notes();
        $current->setIdProfesseur($data['ID_PROF']);
        $current->setIdNote($data['ID_NOTE']);
        $current->setIdEleve($data['ID_ELEVE']);
        $current->setNote($data['NOTE']);
        $current->setCoeff($data['COEFF']);
        $current->setIdMatiere($data['ID_MATIERE']);
        array_push($tab, $current);
        }
        return $tab;

}

 // Permet de selectionner tous les cours dans la base de donnée. 
 public function selectByIdMatiere(){
    $query ="SELECT * FROM notes WHERE ID_MATIERE = :idmatiere;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idmatiere',$this->idMatiere,PDO::PARAM_INT);
    $result->execute();
    $datas= $result->fetchAll();

    $tab=[];
    foreach($datas as $data) {
        $current = new Notes();
        $current->setIdProfesseur($data['ID_PROF']);
        $current->setIdNote($data['ID_NOTE']);
        $current->setIdEleve($data['ID_ELEVE']);
        $current->setNote($data['NOTE']);
        $current->setCoeff($data['COEFF']);
        $current->setIdMatiere($data['ID_MATIERE']);
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
    $this->setIdProfesseur($data['ID_PROF']);
    $this->setIdEleve($data['ID_ELEVE']);
    $this->setIdNote($data['ID_NOTE']);
    $this->setCoeff($data['COEFF']);
    $this->setIdMatiere($data['ID_MATIERE']);
    $this->setNote($data['NOTE']);
        return $this;
    }

// Permet de modifier un cours dans la base de donnée. 
    public function update(){
            $query ="UPDATE `notes` SET `NOTE`=:note, `ID_MATIERE`=:idmatiere,`ID_PROF`=:idprof, 'COEFF'=:coeff,`ID_ELEVE`=:ideleve, WHERE ID_NOTE = :idnote";
            $result = $this->pdo->prepare($query);
            $result->bindValue("note", $this->note, PDO::PARAM_INT);
            $result->bindValue("coeff", $this->coeff, PDO::PARAM_INT);
            $result->bindValue("idprof", $this->idProfesseur, PDO::PARAM_INT);
            $result->bindValue("ideleve", $this->idEleve, PDO::PARAM_INT);
            $result->bindValue("idmatiere", $this->idMatiere, PDO::PARAM_INT);
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


