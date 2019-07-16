<?php
session_start();
include_once("php/classes/classIncluder.php");
if (isset($_POST['con_password']) && $_POST['con_email'] && $_POST['con_password'] !== NULL){
    $connUser = new User();
    $connUser->setEmail($_POST['con_email']);
    $connUser->setPassword($_POST['con_password']);
    $connUser->connectUser();
}
?>

<html>
<head>
    <title>Connexion - Plancha</title>
    <meta charset="utf-8">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/uikit.css" />
    <script src="js/uikit.js"></script>
    <script src="js/uikit-icons.js"></script>
    <script src="js/users.js"></script>
</head>
<body style="text-align:center">
<?php require_once("php/templates/Navbar.php"); ?>
<h1 class="title">Connexion</h1>
<form method="POST" onsubmit="return checkConnection(this);">
    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: user"></span>
            <input class="uk-input" type="email" id="con_email" name="con_email" placeholder="Adresse mail" autocomplete="email">
        </div>
    </div>

    <div class="uk-margin">
        <div class="uk-inline">
            <span class="uk-form-icon" uk-icon="icon: lock"></span>
            <input class="uk-input" type="password" id="con_password" name="con_password" placeholder="*******" autocomplete="current-password">
        </div>
        <div class="uk-margin">
            <input type="submit" value="Envoyer" class="uk-button uk-button-default">
        </div>
        <div id="getAnswer"></div>
    </div>

</form>
</body>
</html>
