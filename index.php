<?php
session_start(['cookie_lifetime' => 3600]);





require_once 'config.php';

require_once 'tools/toolsConnexion.php';
require_once 'tools/toolsMenu.php';
require_once 'tools/toolsSecurity.php';
require_once 'tools/toolsPdf.php';
require_once 'tools/toolsNiceDisplay.php';

require_once 'views/header.html';
require_once 'views/menu.php';

$connexion = connexion();

if (!empty($_SESSION['alert'])) {
    if (!empty($_SESSION['alert-color'])
        && in_array($_SESSION['alert-color'], ['danger', 'info', 'success', 'warning']) // white-list
    ) {
        $alertColor = $_SESSION['alert-color'];
        unset($_SESSION['alert-color']);
    } else {
        $alertColor = 'danger';
    }
    echo '<div class="alert alert-' . $alertColor . '">' . $_SESSION['alert'] . '</div>';
    unset($_SESSION['alert']);
}



if (!empty($_GET['sent'])) {
    // Redirige les utilisateurs connectés qui essaient d'accéder à la page de connexion
    if ($_GET['sent'] == 'views/authLoginView' && !empty($_SESSION['name'])) {
        header('Location: index.php?sent=views/arrayFormations');
        die;
    }
    extension($_GET['sent']);
} else {
    if (!empty($_SESSION['name'])) {
        header('Location: index.php?sent=views/arrayFormations');
    } else {
        header('Location: index.php?sent=views/authLoginView');
    }
}
?>


