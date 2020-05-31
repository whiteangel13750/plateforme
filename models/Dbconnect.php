<?php

// Le DBconnect permet de faire la liaison à la base de donnée grace au PDO

abstract class Dbconnect implements Crud {
    protected $pdo;
    protected $id;
    
    function __construct($id = null) {
        $this->pdo = new PDO(DATABASE, LOGIN, PASSWD);
        $this->id = $id;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    abstract function selectAll();
    abstract function insert();
    abstract function select();
    abstract function update();
    abstract function delete();

}
?>