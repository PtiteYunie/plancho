<?php

require_once("Database.php");

class User
{
    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $phone;
    private $isAdm;

    public function __construct($id = null, $username = null, $firstName = null, $lastName = null, $email = null, $password = null, $phone = null, $isAdm = null){
        $this->setId($id);
        $this->setUsername($username);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setPhone($phone);
        $this->setIsAdm($isAdm);
    }

    public function setId($id){ $this->id = $id; }
    public function setUsername($username){ $this->username = $username; }
    public function setFirstName($firstName){ $this->firstName = $firstName; }
    public function setLastName($lastName){ $this->lastName = $lastName; }
    public function setEmail($email){ $this->email = $email; }
    public function setPassword($password){ $this->password = $password; }
    public function setPhone($phone){ $this->phone = $phone; }
    public function setIsAdm($isAdm){ $this->isAdm = $isAdm; }

    public function getId(){ return $this->id; }
    public function getUsername(){ return $this->username; }
    public function getFirstName(){ return $this->firstName; }
    public function getLastName(){ return $this->lastName; }
    public function getEmail(){ return $this->email; }
    public function getPassword(){ return $this->password; }
    public function getPhone(){ return $this->phone; }
    public function getIsAdm(){ return $this->isAdm; }

    public function registerUser(){
        $database = Database::getDatabaseConnection(); // Connexion à la base de données
        if ($this->userExists() == false) { // Si l'adresse mail n'est pas utilisée
            if ($this->checkUser()) { // Si l'User est correctement rempli / formaté
                $hashedPassword = sha1($this->password); // Hashage du mot de passe en SHA1.
                $insertUser = $database->prepare("INSERT INTO user (username, firstName, lastName, email,  password, isAdm, phone) 
                                                        VALUES (?, ?, ?, ?, ?, ?, ?)");
                try {
                    $insertUser->execute([
                        $this->username,
                        $this->firstName,
                        $this->lastName,
                        $this->email,
                        $hashedPassword,
                        0, // 0 = Utilisateur normal, 1 = Administrateur.
                        $this->phone
                    ]);
                } catch (Error $e) {
                    return $e->getMessage();
                }
            } else {
                return "Vous avez mal rempli le formulaire. ";
            }
        }
        else {
            return "L'utilisateur existe déjà.";
        }
    }
    public function userExists(){
        $database = Database::getDatabaseConnection();
        $userExists = $database->prepare('SELECT * FROM user WHERE email = ?');
        if($userExists->execute(array($this->email)) > 0){
            return $userExists->fetch(PDO::FETCH_ASSOC); // On renvoie les informations de l'utilisateur récupéré
        }
        else {
            return false;
        }
    }
    public function connectUser(){
        if ($this->userExists() !== false) { // Si l'utilisateur existe
            $userExists = $this->userExists();
            if(hash_equals(sha1($this->password), $userExists['password'])) { // Si le mot de passe entré est correct
                // if($userExists['code'] == "V") {
                    $user = new User($userExists['id'], $userExists['username'], $userExists['firstName'], $userExists['lastName'],
                        $userExists['email'], $userExists['password'], $userExists['phone'], $userExists['isAdm']);
                    $user->createSession();
                    header("Location: index.php");
            //    }
             //   else{
                    echo 'L\'utilisateur n\'est pas validé, vérifiez vos mails pour pouvoir le valider.';
            //    }
            }
            else {
                echo 'Mot de passe incorrect.';
            }
        }
        else {
            echo 'L\'email mentionnée n\'existe pas.';
        }
    }
    public function createSession(){
        unset($this->password);
        $_SESSION['user'] = $this;
        $_SESSION['isConnected'] = true;
        $_SESSION['isAdm'] = $this->isAdm;
    }
    public function checkUser(){
        return true;
        // TODO : Réaliser les checks
    }

    static function checkPassword($password, $verif){
        if ($verif !== $password){
            return false;
        }
        else {
            return true;
        }
    }
    static function activateUser($email, $code){
        $database = Database::getDatabaseConnection();
        $query = $database->prepare('SELECT * from user WHERE email = ? AND code = ? ');
        $query->execute(array($email, $code));

        if ($query != false){
            $activate = $database->prepare("UPDATE user SET code = V WHERE email = ?");
            $activate->execute(array($email));
            return true;
        }
        else {
            return false;
        }
    }

    static function getAllUsers(){
        $database = Database::getDatabaseConnection();

        $getUsers = $database->prepare("SELECT * FROM user ");
        $getUsers->execute();

        return $getUsers->fetchAll(PDO::FETCH_ASSOC);
    }

}