<?php

// La classe instancie une nouvelle cours. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base
class Cours extends Dbconnect {
    public $idCours;
    public $titre;
    public $contenu;
    public $image;
    public $idUtilisateur;
    public $idMatiere;
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

    public function getTitre() {
        return $this->titre;
    }
    
    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getContenu() {
        return $this->contenu;
    }
    
   
    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }   

    public function getImage() {
        return $this->image;
    }
    
    public function setImage($image) {
        $this->image = $image;
    }
    

    public function getIdCours() {
        return $this->idCours;
    }

    public function setIdCours($id2) {
        $this->idCours = $id2;
    }

    public function getIdMatiere() {
        return $this->idMatiere;
    }

    public function setIdMatiere($id3) {
        $this->idMatiere = $id3;
    }

   // Permet d'inserer un cours dans la base de donnée. 
    public function insert(){
        $query = "INSERT INTO cours (TITRE, CONTENU, IMAGE, ID_USER, ID_MATIERE) VALUES (:titre, :contenu, :image, :id, :idmati)";
        $result = $this->pdo->prepare($query);
        $result->bindValue("titre", $this->titre, PDO::PARAM_STR);
        $result->bindValue("contenu", $this->contenu, PDO::PARAM_STR);
        $result->bindValue("image", $this->image, PDO::PARAM_STR);
        $result->bindValue("id", $this->idUtilisateur, PDO::PARAM_INT);
        $result->bindValue("idmati", $this->idMatiere, PDO::PARAM_INT);
        var_dump($result);
        $result->execute();
        $this->idCours = $this->pdo->lastInsertId();
        var_dump($this);
        return $this;
    }

  // Permet de selectionner tous les cours dans la base de donnée. 
public function selectAll(){
        $query ="SELECT * FROM cours;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas= $result->fetchAll();

        $tab=[];

        foreach($datas as $data) {
            $current = new Cours();
                $current->setIdMatiere($data['ID_MATIERE']);
                $current->setIdUtilisateur($data['ID_USER']);
                $current->setIdCours($data['ID_COURS']);
                $current->setTitre($data['TITRE']);
                $current->setContenu($data['CONTENU']);
                $current->setImage($data['IMAGE']);
            array_push($tab, $current);
            }
            return $tab;

    }
  // Permet de selectionner tous les cours dans la base de donnée. 
  public function selectByUser(){
    $query ="SELECT * FROM cours WHERE ID_USER = :iduser ;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':iduser',$this->idUtilisateur,PDO::PARAM_INT);
    $result->execute();
    $datas= $result->fetchAll();

    $tab=[];
    foreach($datas as $data) {
        $current = new Cours();
            $current->setIdMatiere($data['ID_MATIERE']);
            $current->setIdUtilisateur($data['ID_USER']);
            $current->setIdCours($data['ID_COURS']);
            $current->setTitre($data['TITRE']);
            $current->setContenu($data['CONTENU']);
            $current->setimage($data['IMAGE']);
        array_push($tab, $current);
        }
        return $tab;

}
// Permet de selectionner un cours dans la base de donnée. 
public function select(){
    $query = "SELECT * FROM cours WHERE ID_COURS = :idcours;";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idcours',$this->idCours,PDO::PARAM_INT);
    $result->execute();
    $data = $result->fetch();
    $this->setIdMatiere($data['ID_MATIERE']);
    $this->setIdUtilisateur($data['ID_USER']);
    $this->setIdCours($data['ID_COURS']);
    $this->setTitre($data['TITRE']);
    $this->setimage($data['IMAGE']);
    $this->setContenu($data['CONTENU']);
        return $this;
    }

// Permet de modifier un cours dans la base de donnée. 
    public function update(){
            $query ="UPDATE `cours` SET `TITRE`=:titre, `CONTENU`=:contenu, `IMAGE`=:image,`ID_USER`=:iduser, `ID_MATIERE`=:idmati WHERE ID_COURS = :idcours";
            $result = $this->pdo->prepare($query);
            $result->bindValue(':idmati',$this->idMatiere,PDO::PARAM_INT);
            $result->bindValue(':idcours',$this->idCours,PDO::PARAM_INT);
            $result->bindValue(':titre',$this->titre,PDO::PARAM_STR);
            $result->bindValue(':contenu',$this->contenu,PDO::PARAM_STR);
            $result->bindValue(':image',$this->image,PDO::PARAM_STR);
            $result->bindValue(':iduser',$this->idUtilisateur,PDO::PARAM_INT);
            $result->execute();
            var_dump($result);
    }

// Permet de supprimer un cours dans la base de donnée. 
    public function delete(){
        $query ="DELETE FROM `cours` WHERE ID_COURS = :idcours";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idcours',$this->idCours,PDO::PARAM_INT);
    $result->execute();
    }

}

?>


