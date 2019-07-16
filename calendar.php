<?php
session_start();
if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true) {
    //header("Location: planning.php");
    echo "Vous êtes bien connecté.";
}

$diplayCalendar = false;
if (isset($_GET['m']) && isset($_GET['Y'])) {
    require_once "php/classes/Calendar.php";
    $calendar = new Calendar($_GET['m'], $_GET['Y']);
    $diplayCalendar = true;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Plancha 2.0</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/uikit.css">
</head>

<body>
<?php require_once("php/templates/Navbar.php"); ?>

<?php if ($diplayCalendar === true) {
    $calendar->displayCalendar();

} else {
    echo "Calendrier indisponible";

} ?>


<script src="js/uikit.js"></script>
<script src="js/uikit-icons.js"></script>
</body>
</html>
