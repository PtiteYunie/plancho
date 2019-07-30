<?php
if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true && $_SESSION['isAdm'] == 0){
?>
    <!-- S'il est connecté -->
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li uk-tooltip="title: Retournez à l'accueil"><a href="index.php">Accueil</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="calendrier.php">Planning</a></li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="profil.php">Profil</a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li uk-tooltip="title: Voir mes informations"><a href="profil.php#mesinfos">Mes informations</a></li>
                            <li class="uk-nav-divider"></li>
                            <li uk-tooltip="title: Quitter Fight Food Waste"><a href="disconnect.php">Déconnexion</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

<?php
} else if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true && $_SESSION['isAdm'] == 1 && getcwd() != "/Applications/XAMPP/xamppfiles/htdocs/PLC/plancho/admin") {
    ?>
    <!-- S'il est administrateur et hors du dossier admin -->
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li uk-tooltip="title: Retournez à l'accueil"><a href="index.php">Accueil</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="calendrier.php">Planning</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="admin/index.php">Panel Administrateur</a></li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="profil.php">Profil</a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li uk-tooltip="title: Voir mes informations"><a href="profil.php#mesinfos">Mes informations</a></li>
                            <li class="uk-nav-divider"></li>
                            <li uk-tooltip="title: Quitter Fight Food Waste"><a href="disconnect.php">Déconnexion</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

<?php
} else if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] == true && $_SESSION['isAdm'] == 1 && getcwd() == "/Applications/XAMPP/xamppfiles/htdocs/PLC/plancho/admin") {
    ?>
    <!-- S'il est administrateur et dans le dossier admin -->
    <nav class="uk-navbar-container" uk-navbar>
        <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
                <li uk-tooltip="title: Retournez à l'accueil"><a href="../index.php">Accueil</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="../calendrier.php">Planning</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="../admin/index.php">Panel Administrateur</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="../admin/usersAdmin.php">Gestion des utilisateurs</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="../admin/vacationsAdmin.php">Gestion des vacations</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="../admin/forbiddenAdmin.php">Gestion des interdits</a></li>
                <li uk-tooltip="title: Accédez au planning"><a href="../admin/requestAdmin.php">Gestion des requêtes</a></li>
            </ul>
        </div>
        <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
                <li>
                    <a href="profil.php">Profil</a>
                    <div class="uk-navbar-dropdown">
                        <ul class="uk-nav uk-navbar-dropdown-nav">
                            <li uk-tooltip="title: Voir mes informations"><a href="profil.php#mesinfos">Mes informations</a></li>
                            <li class="uk-nav-divider"></li>
                            <li uk-tooltip="title: Quitter Fight Food Waste"><a href="disconnect.php">Déconnexion</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
<?php } else {
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

<?php
} ?>
