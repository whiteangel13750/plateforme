<?php

// La classe instancie une nouvelle cours. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base
class Matiere extends Dbconnect {
    public $idMatiere;
    public $matiere;

// Le construct permet d'établir une structure de notre tache
    function __construct($id=null) {
     parent::__construct($id);
}
// La syntaxe get permet de lier une propriété d'un objet à une fonction qui sera appelée lorsqu'on accédera à la propriété.
    public function getIdMatiere() {
        return $this->idMatiere;
    }
// La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdMatiere($id) {
        $this->idMatiere = $id;
    }

    public function getMatiere() {
        return $this->matiere;
    }

    public function setMatiere($matiere) {
        $this->matiere = $matiere;
    }

   // Permet d'inserer un cours dans la base de donnée. 
    public function insert(){
        $query = "INSERT INTO matiere (matiere) VALUES (:matiere)";
        $result = $this->pdo->prepare($query);
        $result->bindValue("matiere", $this->eleve, PDO::PARAM_STR);
        $result->execute();
        $this->idMatiere = $this->pdo->lastInsertId();
        var_dump($this);
        return $this;
    }

  // Permet de selectionner tous les cours dans la base de donnée. 
public function selectAll(){
        $query ="SELECT * FROM matiere;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas= $result->fetchAll();

        $tab=[];

        foreach($datas as $data) {
            $current = new Matiere();
            $current->setIdMatiere($data['ID_MATIERE']);
            $current->setMatiere($data['MATIERE']);
            array_push($tab, $current);
            }
            return $tab;

    }

// Permet de selectionner un cours dans la base de donnée. 
public function select(){
    $query = "SELECT * FROM matiere WHERE id_matiere = :idmatiere;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idmatiere',$this->idMatiere,PDO::PARAM_INT);
    $result->execute();
    $data = $result->fetch();
    $this->setIdMatiere($data['id_matiere']);
    $this->setMatiere($data['matiere']);
        return $this;
    }

// Permet de modifier un cours dans la base de donnée. 
    public function update(){
            $query ="UPDATE `matiere` SET `matiere`=:matiere, WHERE ID_MATIERE = :idmatiere";
            $result = $this->pdo->prepare($query);
            $result->bindValue(':idmatiere',$this->idMatiere,PDO::PARAM_INT);
            $result->bindValue(':matiere',$this->matiere,PDO::PARAM_STR);
            $result->execute();
            var_dump($result);
    }

// Permet de supprimer un cours dans la base de donnée. 
    public function delete(){
        $query ="DELETE FROM `matiere` WHERE ID_MATIERE = :idmatiere";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idmatiere',$this->idMatiere,PDO::PARAM_INT);
    $result->execute();
    }

}

?>


