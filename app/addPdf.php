<?php

if (!empty($_SESSION['name']) && isset($_POST['id_formation']) && isset($_FILES['pdfFile'])) {

    global $connexion;
    $connexion = connexion();

    $idFormation = $_POST['id_formation'];
    $pdfFile = $_FILES['pdfFile'];

    $uploadDir = './uploads/pdfs/';
    $fileExtensions = ['pdf'];
    $fileSizeMax = 5242880; //5MB

    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            $_SESSION['alert'] = "&#9940; La création du répertoire upload n'a pas pu se faire. &#9940;";
            $_SESSION['alert-color'] = 'danger';
            header('Location: index.php?sent=views/arrayFormation');
            die;
        }
    }

    $fileName = $_FILES['pdfFile']['name'];
    $fileSize = $_FILES['pdfFile']['size'];
    $fileTmpName = $_FILES['pdfFile']['tmp_name'];
    //ex = 'livret découverte école maternelle.pdf' +
    //$fileTmpName = 'C:\wamp64\tmp\php3C6.tmp ==> la configuration tmp...(path) défini dans php.ini
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    //ex : $fileType = 'pdf'


    if (!in_array($fileType, $fileExtensions)) {
        $_SESSION['alert'] = "&#9940; Seuls les fichiers PDF sont autorisés. &#9940;";
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?sent=views/arrayFormations');
        die;
    }

    if ($fileSize > $fileSizeMax) {
        $_SESSION['alert'] = "&#9940; Le fichier dépasse la taille maximale de 5MB. &#9940;";
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?sent=views/arrayFormations');
        die;
    }

    $cleanFileName = microtime(true) . '-' . sanitizeFilename($fileName); // Add a random prefix
    $newFilePath = $uploadDir . $cleanFileName;

    if (file_exists($newFilePath)) {
        $_SESSION['alert'] = "&#9940; Le fichier existe déjà. &#9940;";
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?sent=views/arrayFormations');
        die;
    }

    if (move_uploaded_file($fileTmpName, $newFilePath)) {

        $params = [
            $cleanFileName,
            $idFormation
        ];

        /* *** 2.query *** */
        $query = $connexion->prepare("
            UPDATE formations 
            SET fichier_horaire_pdf = ?
            WHERE id_formation = ?
        ");

        /* *** 3.execute *** */
        $query->execute($params);

        if ($query->execute()) {
            $_SESSION['alert'] = "&#9989; Le fichier " . htmlspecialchars($cleanFileName) . " a été téléchargé.";
            $_SESSION['alert-color'] = 'success';
            header('Location: index.php?sent=views/arrayFormations');
            die;


            /*--------------------------------------------------------------------*/
        } else {
            echo "Erreur lors de la mise à jour du fichier PDF dans la base de données.";
        }

    } else {
        $_SESSION['alert'] = "&#9940; Erreur : Le téléchargement a échoué. &#9940;";
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?sent=views/arrayFormations');
        die;
    }
} else {
    $_SESSION['alert'] = "&#9940; Aucun fichier téléchargé. &#9940;";
    $_SESSION['alert-color'] = 'danger';
    header('Location: index.php?sent=views/arrayFormations');
    die;

}
?>

