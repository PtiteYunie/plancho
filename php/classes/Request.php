<?php


class Request
{
    private $id;
    private $idUser;
    private $date;
    private $idVac;

    public function __construct($id = null, $idUser = null, $date = null, $idVac = null)
    {
        $this->id=$id;
        $this->idUser=$idUser;
        $this->date=$date;
        $this->idVac=$idVac;
    }

    public function addRequest(){
        $database = Database::getDatabaseConnection();

        $add = $database->prepare("INSERT INTO vacation (label, name) VALUES (?, ?)");
        if($add->execute(array($this->label, $this->name))){
            return true;
        }
        else {
            return false;
        }
    }


}