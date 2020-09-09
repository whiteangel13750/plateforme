<?php

// La classe instancie une nouvelle cours. Elle est liée à DbConnect qui permet de lier la base de donnée à la classe. 
// Elle requiert les méthodes afin d'agrémenter la base
class Minitchat extends Dbconnect {
    public $idMini;
    public $pseudo;
    public $message;
    public $date;
    public $idUtilisateur;

// Le construct permet d'établir une structure de notre tache
    function __construct($id=null) {
     parent::__construct($id);
}
// La syntaxe get permet de lier une propriété d'un objet à une fonction qui sera appelée lorsqu'on accédera à la propriété.
    public function getIdMini() {
        return $this->idMini;
    }
// La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdMini($idMini) {
        $this->idMini = $idMini;
    }

    // La syntaxe get permet de lier une propriété d'un objet à une fonction qui sera appelée lorsqu'on accédera à la propriété.
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }
// La syntaxe set permet de lier une propriété d'un objet à une fonction qui sera appelée à chaque tentative de modification de cette propriété.
    public function setIdUtilisateur(int $id) {
        $this->idUtilisateur = $id;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getDate() {
        return $this->date;
    }

    public function setDate($date) {
        $this->date = $date;
    }



   // Permet d'inserer un cours dans la base de donnée. 
    public function insert(){
        $query = "INSERT INTO minichat (pseudo, message, date)  VALUES (:pseudo, :message, NOW())";
        $result = $this->pdo->prepare($query);
        $result->bindValue("pseudo", $this->pseudo, PDO::PARAM_STR);
        $result->bindValue("message", $this->message, PDO::PARAM_STR);
        $result->execute();
        $this->idMini = $this->pdo->lastInsertId();
        var_dump($this);
        return $this;
    }

  // Permet de selectionner tous les cours dans la base de donnée. 
public function selectAll(){
        $query ="SELECT * FROM minichat;";
        $result = $this->pdo->prepare($query);
        $result->execute();
        $datas= $result->fetchAll();
        $tab=[];

        foreach($datas as $data) {
            $current = new Minitchat();
            $current->setIdMini($data['id']);
            $current->setPseudo($data['pseudo']);
            $current->setMessage($data['message']);
            $current->setDate($data['date']);
            array_push($tab, $current);
            }
            return $tab;

    }

// Permet de selectionner un cours dans la base de donnée. 
public function select(){
    $query = "SELECT * FROM minichat WHERE id = :idmini ORDER BY id DESC LIMIT 0, 10";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idmini',$this->idMini,PDO::PARAM_INT);
    $result->execute();
    $data = $result->fetch();
    $this->setIdMini($data['id']);
    $this->setPseudo($data['pseudo']);
    $this->setMessage($data['message']);
    $this->setDate($data['date']);
        return $this;
    }

// Permet de modifier un cours dans la base de donnée. 
    public function update(){
            $query ="UPDATE `minichat` SET `pseudo`=:pseudo,`message`=:message,`date`=:date, WHERE id= :idmini";
            $result = $this->pdo->prepare($query);
            $result->bindValue(':idmini',$this->idMini,PDO::PARAM_INT);
            $result->bindValue(':pseudo',$this->pseudo,PDO::PARAM_STR);
            $result->bindValue(':message',$this->message,PDO::PARAM_STR);
            $result->bindValue(':date',$this->date,PDO::PARAM_STR);
            $result->execute();
            var_dump($result);
    }

// Permet de supprimer un cours dans la base de donnée. 
    public function delete(){
        $query ="DELETE FROM `minichat` WHERE id = :idmini";
    $result = $this->pdo->prepare($query);
    $result->bindValue(':idmini',$this->idMini,PDO::PARAM_INT);
    $result->execute();
    }

}

?>


