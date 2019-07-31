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

    static function getAllRequestsByDate($dateStart, $dateEnd){
        $database = Database::getDatabaseConnection();

        $get = $database->prepare("SELECT * FROM request WHERE date BETWEEN ? AND ?");
        if ($get->execute(array($dateStart, $dateEnd))){
            return $get->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }

    static function deleteRequest($id){
        $database = Database::getDatabaseConnection();

        $delete = $database->prepare("DELETE FROM request WHERE id = ?");
        if ($delete->execute(array($id))){
            return true;
        }
        else {
            return false;
        }
    }

    static function getAllRequestByUser($id){
        $database = Database::getDatabaseConnection();

        $get = $database->prepare('SELECT * FROM request WHERE idUser = ?');
        if ($get->execute(array($id))){
            return $get->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }
    }
}
