<?php
/**
 * Created by PhpStorm.
 * User: wassimdahmane
 * Date: 03/04/2019
 * Time: 14:50
 */

include_once("php/classes/classIncluder.php");
if (isset($_POST['reg_password']) && $_POST['reg_verifPassword'] != NULL){
    $username = $_POST['reg_firstName'] . "." . $_POST['reg_lastName'];
    $user = new User(
        null,
        $username,
        $_POST['reg_firstName'],
        $_POST['reg_lastName'],
        $_POST['reg_email'],
        $_POST['reg_password'],
        $_POST['reg_phone'],
        0
    );
    if (User::checkPassword($_POST['reg_password'], $_POST['reg_verifPassword'])) {
        if($user->registerUser() == true){
            echo $user->registerUser();
            echo "Inscription réussie. Vérifiez vos mails.";
            header("Refresh:5; url=index.php");
        }
        else
            {
            echo $user->registerUser();
            var_dump($_POST);
        }
    }
    else {
        echo 'Les mots de passes ne correspondent pas.';
    }
}
if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true){
    http_response_code(403);
    exit();
}

/************************************************************************* USER ACTIVATION *************************************************************************/
if (isset($_GET['c']) && isset($_GET['e'])){
    if(User::activateUser($_GET['e'], $_GET['c'])){
        echo "<h1 class='uk-h1'>Compte validé!</h1>";
        header("Refresh:5; url='index.php'");
    }
}


?>

<html>
<head>
    <title>Inscription - Plancha</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/uikit.css" />
    <script src="js/uikit.js"></script>
    <script src="js/uikit-icons.js"></script>
</head>
<body style="text-align:center">
<?php require_once("php/templates/Navbar.php"); ?>
<!-- firstName lastName birthday email password phone address postalCode city regDate lastConnection-->
<div class="uk-align-center">
    <div class="uk-background-secondary uk-light uk-padding uk-panel">
        <p class="uk-h1">Inscription</p>
    </div>
</div>

<form method="POST" onsubmit="return checkRegistration(this);">
    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="text" id="reg_firstName" name="reg_firstName" placeholder="Prénom" autocomplete="name">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="text" id="reg_lastName" name="reg_lastName" placeholder="Nom" autocomplete="name">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: mail"></span>
            <input class="uk-input" type="email" id="reg_email" name="reg_email" placeholder="Adresse Mail" autocomplete="email">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: receiver"></span>
            <input class="uk-input" type="text" id="reg_phone" name="reg_phone" placeholder="N° de téléphone" autocomplete="mobile">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input class="uk-input" type="password" id="reg_password" name="reg_password" placeholder="Mot de passe" autocomplete="password">
        </div>

    </div>
    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input class="uk-input" type="password" id="reg_verifPassword" name="reg_verifPassword" placeholder="Confirmation" autocomplete="password">
        </div>
    </div>
    <input type="submit" value="Envoyer">
</form>
</body>

<script src="js/users.js">
</script>
</html>

