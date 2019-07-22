<?php
require_once "php/classes/classIncluder.php";
if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true) {
    //header("Location: planning.php");
    echo "Vous êtes bien connecté.";
}

$displayCalendar = false;
if (isset($_GET['m']) && isset($_GET['Y'])) {
    require_once "php/classes/Calendar.php";
    $calendar = new Calendar($_GET['m'], $_GET['Y']);
    $displayCalendar = true;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Plancha 2.0</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/uikit.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<?php require_once("php/templates/Navbar.php"); ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
        </div>
        <?php if ($diplayCalendar === true) {
            $calendar->displayCalendar();

        } else {
            echo "Calendrier indisponible";

        } ?>
    </div>
</div>

<script src="js/uikit.js"></script>
<script src="js/uikit-icons.js"></script>
</body>

<script src="js/calendar.js"></script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</html>
