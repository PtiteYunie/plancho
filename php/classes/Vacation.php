<?php
/**
 * Created by PhpStorm.
 * User: wassimdahmane
 * Date: 16/07/2019
 * Time: 12:00
 */

class Vacation
{
    private $id;
    private $label;
    private $name;

    public function __construct($id = null, $label = null, $name = null){
        $this->setId($id);
        $this->setLabel($label);
        $this->setName($name);
    }

    public function setId($id){ $this->id = $id; }
    public function setLabel($label){ $this->label = $label; }
    public function setName($name){ $this->name = $name; }

    public function getId(){ return $this->id; }
    public function getLabel(){ return $this->label; }
    public function getName(){ return $this->name; }

    public function addVacation(){
        $database = Database::getDatabaseConnection();

        $add = $database->prepare("INSERT INTO vacation (label, name) VALUES (?, ?)");
        if($add->execute(array($this->label, $this->name))){
            return true;
        }
        else {
            return false;
        }
    } // Nécessite d'avoir créé un objet au préalable.
    static function getAllVacations(){
        $database = Database::getDatabaseConnection();

        $get = $database->prepare("SELECT * FROM vacation");

        if($get->execute()){
            return $get->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            return false;
        }

    }
    static function editLabel($id, $label){
        $database = Database::getDatabaseConnection();

        $get = $database->prepare("UPDATE vacation SET label = ? WHERE id = ?");

       if($get->execute(array($label, $id))){
           return true;
       }
       else {
           return false;
       }
    }
    static function editName($id, $name){
        $database = Database::getDatabaseConnection();

        $get = $database->prepare("UPDATE vacation SET name = ? WHERE id = ?");

        if($get->execute(array($name, $id))){
            return true;
        }
        else {
            return false;
        }
    }
    static function deleteVacation($id){
        $database = Database::getDatabaseConnection();

        $delete = $database->prepare("DELETE FROM vacation WHERE id = ?");
        if ($delete->execute(array($id))){
            return true;
        }
        else {
            return false;
        }
    }
    static function getVacationById($id){
        $database = Database::getDatabaseConnection();

        $get = $database->prepare("SELECT label, name FROM vacation WHERE id = ?");
        if ($get->execute(array($id))){
            return $get->fetch(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    }
}