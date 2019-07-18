<?php
require_once("php/classes/classIncluder.php");
if (!isset($_SESSION) || $_SESSION['isConnected'] != true){
    echo "Vous n'êtes pas connecté.";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Plancho - Planning</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/uikit.css" />
    <script src="js/uikit.js"></script>
    <script src="js/uikit-icons.js"></script>
</head>

<body>
<?php

$database = Database::getDatabaseConnection();
// 2 : Permets de récupérer le planning d'un mois choisi

$getMonth = $database->prepare("SELECT * FROM planning WHERE MONTH(date) = ? ORDER BY date ASC");
$getMonth->execute(array(7));
$result = $getMonth->fetch(PDO::FETCH_ASSOC);

?>
</body>
</html>
