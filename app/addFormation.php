<?php

$url = 'index.php?sent=views/arrayFormations';
$urlTwo = 'index.php?sent=views/addFormationView';

if (!empty($_SESSION['name'])) {

//1. SIMPLE & BASIC VERIFICATION
    if (!empty($_POST['name']) && !empty($_POST['enseignant'])) {
        $errors = [];

        //2. VERIFICATIONS WITH FUNCTIONS SECURITY
        if (!validateName($_POST['name'])) {
            $errors[] = '<br> - Le nom de la formation est invalide.';
        }
        if (!validateName($_POST['enseignant'])) {
            $errors[] = '<br> - Le nom de l\'enseignant est invalide.';
        }
        if (!validateNumber($_POST['duree'], $_POST['etudiantMax'])) {
            $errors[] = "<br> - La durée et le nombre d'étudiants ne peuvent pas être vides ou égaux à 0.";
        }

        //3. 0 ERROR, TO BE CONTINUED... CLEAN DATA
        if (empty($errors)) {
            $name = cleanData($_POST['name'], 'string');
            $duree = cleanData($_POST['duree'], 'int');
            $enseignant = cleanData($_POST['enseignant'], 'string');
            $etudiantMax = cleanData($_POST['etudiantMax'], 'int');
            $active = isset($_POST['active']) ? 1 : 0;

            //4. FUNCTION CONNEXION PDO
            $connexion = connexion();

            //5. DUPLICATE CHECK NAME
            if (!checkUniqueFormationName($name)) {
                $errors[] = '<br> - Le nom de la formation existe déjà.';
            }
            //6. CHECK NUMBER ETUDIANTS
            if ($etudiantMax < 10 || $etudiantMax > 20) {
                $errors[] = '<br> - Le nombre d\'étudiants doit être compris entre 10 et 20.';
            }

            //-------PDF--------PDF--------PDF-------PDF-------PDF
            //7. ADD PDF
            if (!empty($_FILES['pdfFile']['name'])) {

                $pdfFile = $_FILES['pdfFile'];
                $uploadDir = './uploads/pdfs/';
                $fileExtensions = ['pdf'];
                $fileSizeMax = 5242880; //5MB

                if (!is_dir($uploadDir)) {
                    if (!mkdir($uploadDir, 0777, true)) {
                        $errors[] = '<br> - La création du répertoire upload n\'a pas pu se faire.';
                    }
                }

                $fileName = $_FILES['pdfFile']['name'];
                $fileSize = $_FILES['pdfFile']['size'];
                $fileTmpName = $_FILES['pdfFile']['tmp_name'];
                $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (!in_array($fileType, $fileExtensions)) {
                    $errors[] = '<br> - Seuls les fichiers PDF sont autorisés.';
                }

                if ($fileSize > $fileSizeMax) {
                    $errors[] = '<br> - Le fichier PDF dépasse la taille maximale de 5MB.';
                }

                $cleanFileName = microtime(true) . '-' . sanitizeFilename($fileName); // Add a random prefix
                $newFilePath = $uploadDir . $cleanFileName;

                if (move_uploaded_file($fileTmpName, $newFilePath)) {

                    //-------PDF--------PDF--------PDF-------PDF-------PDF

                    //8. PARAMS QUERY
                    $params = [$name, $duree, $enseignant, $etudiantMax, $cleanFileName, $active];

                    //9. CONNEXION & QUERY
                    /* *** 2.query *** */
                    $query = $connexion->prepare("
                    INSERT INTO formations (nom_formation, duree_formation, nom_enseignant, nb_etudiants_max, fichier_horaire_pdf, active)
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                    /* *** 3.execute *** */
                    $query->execute($params);
                    $_SESSION['alert'] = "Formation enregistrée avec succès !";
                    $_SESSION['alert-color'] = 'success';
                    header('Location: ' . $url);
                    die;

                } else {
                    $_SESSION['alert'] = "&#9940; Erreur : Le téléchargement du fichier PDF a échoué. &#9940;";
                    $_SESSION['alert-color'] = 'danger';
                    header('Location: index.php?sent=views/addFormation');
                    die;
                }

            }else{
                $errors[] = '<br> - Il manque le pdf';
            }

        } //end if $errors
        if (!empty($errors)) {
            $_SESSION['alert'] = "	&#9940; &#9888;&#65039; Veuillez corriger les erreurs suivantes : " . implode('<br>', $errors);
            $_SESSION['alert-color'] = 'danger';
            header('Location: ' . $urlTwo);
            die;
        }

        /*------------------ELSE-----------------*/

    } else {
        //EMPTY FIELDS
        $_SESSION['alert'] = "&#9940; Oups ! On dirait que vous avez oublié de remplir les champs. &#9940;";
        $_SESSION['alert-color'] = 'danger';
        header('Location: ' . $urlTwo);
        die;
    }
} else {
    //NO SESSION
    header("Location:index.php?sent=views/authLoginView");
    die;
}