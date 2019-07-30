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

    static function getAllRequestsByDate($dateStart){
        $database = Database::getDatabaseConnection();
        $nextMonth = date('Y-m-d', strtotime('+1 month', strtotime($dateStart)));

        $get = $database->prepare("SELECT * FROM request WHERE date BETWEEN ? AND ?");
        if ($get->execute(array($dateStart, $nextMonth))){
            return $get->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }

    static function deleteRequest($id){
        $database = Database::getDatabaseConnection();

        $delete = $database->prepare("DELETE FROM request WHERE id = ?");
        if($delete->execute(array($id))){
            return true;
        }
        else {
            return false;
        }
    }


}
