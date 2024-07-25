<?php

$urlTwo = 'index.php?sent=views/authLoginView';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['name']) && !empty($_POST['password'])) {

        $name = htmlspecialchars($_POST['name']);
        $password = $_POST['password'];

        if ($name === NAME_ADMIN && password_verify($password, PWD_ADMIN)) {
            $_SESSION['name'] = $name;
            $_SESSION['alert'] = 'Bienvenue, Maître des Formations !';
            $_SESSION['alert-color'] = 'success';
            header('Location: index.php?sent=views/arrayFormations');
            die;

            /*--------ELSE--------*/

        } else {
            // NAME ET/OU MOT DE PASSE INCORRECT
            $_SESSION['alert'] = '&#9940; Oops! Il semble que vous ayez tapé votre pseudo et votre mot de passe avec des moufles. Essayez encore, et n\'oubliez pas de retirer les moufles cette fois-ci  &#9940;';
            $_SESSION['alert-color'] = 'danger';
            header('Location: index.php?sent=views/authLoginView');
            die;
        }

    } else {
        // EMPTY FIELDS
        $_SESSION['alert'] = '&#9940; Oups ! On dirait que vous avez oublié de remplir les champs. À moins que vous n\'ayez des pouvoirs magiques, vous devrez entrer votre pseudo et mot de passe pour vous connecter ! &#9940;';
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?sent=views/authLoginView');
        die;
    }

} else {
    // ERREUR POST
    $_SESSION['alert'] = 'ERREUR METHODE POST';
    $_SESSION['alert-color'] = 'danger';
    header('Location: index.php?sent=views/authLoginView');
    die;
}

