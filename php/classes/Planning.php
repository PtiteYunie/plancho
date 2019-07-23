<?php
/**
 * Created by PhpStorm.
 * User: wassimdahmane
 * Date: 16/07/2019
 * Time: 12:00
 */

class Planning
{
    private $id;
    private $idUser;
    private $date;
    private $idVacation;
    private $comment;

    public function __construct($id = null, $idUser = null, $date = null, $idVacation = null, $comment = null){
        $this->setId($id);
        $this->setIdUser($idUser);
        $this->setDate($date);
        $this->setIdVacation($idVacation);
        $this->setComment($comment);
    }

    public function setId($id){ $this->id = $id; }
    public function setIdUser($idUser){ $this->idUser = $idUser; }
    public function setDate($date){ $this->date = $date; }
    public function setIdVacation($idVacation){ $this->idVacation = $idVacation; }
    public function setComment($comment){ $this->comment = $comment; }

    public function getId(){ return $this->id; }
    public function getIdUser(){ return $this->idUser; }
    public function getDate(){ return $this->date; }
    public function getIdVacation(){ return $this->idVacation; }
    public function getComment(){ return $this->comment; }

    // Fonction permettant de récupérer toutes les informations concernant le mois en cours
    static function getCurrentPlanning(){
        $database = Database::getDatabaseConnection();
        // 1 : On récupère toutes les informations par rapport au mois en cours - MONTH(CURDATE()) récupère cette info
        $getMonth = $database->prepare("SELECT * FROM planning WHERE MONTH(date) LIKE MONTH(CURDATE()) ORDER BY date ASC");
        $getMonth->execute();

        return $getMonth->fetch(PDO::FETCH_ASSOC);
    }

    static function getMonthPlanning($month){
        $database = Database::getDatabaseConnection();
        // 2 : Permets de récupérer le planning d'un mois choisi
        $getMonth = $database->prepare("SELECT * FROM planning WHERE MONTH(date) = ? ORDER BY date ASC");
        $getMonth->execute(array($month));
        $result = $getMonth->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    static function getDayPlanning($month, $day, $user){

        $database = Database::getDatabaseConnection();
        // 2 : Permets de récupérer le planning d'un mois choisi
        $getDay = $database->prepare("SELECT * FROM planning WHERE DAY(date) = ? AND MONTH(date) = ? AND idUser = ? ORDER BY date ASC");
        $getDay->execute(array($day, $month, $user));
        $result = $getDay->fetch(PDO::FETCH_ASSOC);

        $getVacationLabel = $database->prepare("SELECT label FROM vacation WHERE id = ?");
        $getVacationLabel->execute(array($result['idVacation']));
        $r = $getVacationLabel->fetch(PDO::FETCH_ASSOC);
        $result = $r['label'];

        return $result;
    }

}