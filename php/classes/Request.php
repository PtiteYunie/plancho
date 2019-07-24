<?php


class Request
{
    private $id;
    private $idUser;
    private $date;
    private $idVac;

    public function __construct($id = null, $idUser = null, $date = null, $idVac = null)
    {
        $this->id = $id;
        $this->idUser = $idUser;
        $this->date = $date;
        $this->idVac = $idVac;
    }

    public function addRequest()
    {
        $database = Database::getDatabaseConnection();

        $add = $database->prepare("INSERT INTO request (idUser, date, idVac) VALUES (?, ?, ?)");
        return $add->execute([$this->idUser, $this->date, $this->idVac]);
    }

    static function getAllRequestsByDate($dateStart,$dateEnd){
        $database = Database::getDatabaseConnection();

        $get = $database->prepare("SELECT * FROM request WHERE date BETWEEN ? AND ?");
        if ($get->execute(array($dateStart,$dateEnd))){
            return $get->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }

}
