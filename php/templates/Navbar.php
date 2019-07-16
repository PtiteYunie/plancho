<?php
if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true && $_SESSION['isAdm'] == 0){
?>
    <!-- S'il est connecté -->
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li uk-tooltip="title: Retournez à l'accueil"><a href="index.php">Accueil</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="#">Planning</a></li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="profil.php">Profil</a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li uk-tooltip="title: Voir mes informations"><a href="profil.php#mesinfos">Mes informations</a></li>
                            <li uk-tooltip="title: Lire mes messages"><a href="messagerie.php">Messagerie</a></li>
                            <li class="uk-nav-divider"></li>
                            <li uk-tooltip="title: Quitter Fight Food Waste"><a href="disconnect.php">Déconnexion</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

<?php
} else {
?>

<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <ul class="uk-navbar-nav">
            <li uk-tooltip="title: Retournez à l'accueil"><a href="index.php">Accueil</a></li>
            <li uk-tooltip="title: Plancho"><a href="register.php">Inscription</a></li>

        </ul>
    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <a href="connection.php"><span class="uk-margin-small-right" ratio="1.5" uk-icon="sign-in">Connexion</span></a>
        </ul>
    </div>
</nav>

    <!-- S'il n'est pas connecté -->
<?php } ?>
