<?php

$url = 'index.php?sent=views/arrayFormations';

if (!empty($_SESSION['name'])) {

//1 SIMPLE & BASIC VERIFICATION
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $urlTwo = 'index.php?sent=views/updateFormationView&id_formation=' . $id;

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
            if (!checkUniqueUpdateFormationName($name, $id)) {
                $errors[] = '<br> - Le nom de la formation existe déjà.';
            } else {
                //6. CHECK NUMBER ETUDIANTS
                if ($etudiantMax < 10 || $etudiantMax > 20) {
                    $errors[] = '<br> - Le nombre d\'étudiants doit être compris entre 10 et 20.';
                } else {
                    //7. PARAMS QUERY
                    $params = [$name, $duree, $enseignant, $etudiantMax, $active, $id];


                    //-------PDF--------PDF--------PDF-------PDF-------PDF
                    //8. ADD PDF (FACULTATIF)
                    if (isset($_FILES['pdfFile']['name']) && !empty($_FILES['pdfFile']['name'])) {

                        $pdfFile = $_FILES['pdfFile'];
                        $uploadDir = './uploads/pdfs/';
                        $fileExtensions = ['pdf'];
                        $fileSizeMax = 5242880; //5MB

                        if (!is_dir($uploadDir)) {
                            if (!mkdir($uploadDir, 0777, true)) {
                                $_SESSION['alert'] = "&#9940; La création du répertoire upload n'a pas pu se faire. &#9940;";
                                $_SESSION['alert-color'] = 'danger';
                                header('Location: index.php?sent=views/updateFormationView&id_formation=' . $id);
                                die;
                            }
                        }

                        $fileName = $_FILES['pdfFile']['name'];
                        $fileSize = $_FILES['pdfFile']['size'];
                        $fileTmpName = $_FILES['pdfFile']['tmp_name'];
                        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                        if (!in_array($fileType, $fileExtensions)) {
                            $_SESSION['alert'] = "&#9940; Seuls les fichiers PDF sont autorisés. &#9940;";
                            $_SESSION['alert-color'] = 'danger';
                            header('Location: index.php?sent=views/updateFormationView&id_formation=' . $id);
                            die;
                        }

                        if ($fileSize > $fileSizeMax) {
                            $_SESSION['alert'] = "&#9940; Le fichier PDF dépasse la taille maximale de 5MB. &#9940;";
                            $_SESSION['alert-color'] = 'danger';
                            header('Location: index.php?sent=views/updateFormationView&id_formation=' . $id);
                            die;
                        }

                        $cleanFileName = microtime(true) . '-' . sanitizeFilename($fileName); // Add a random prefix
                        $newFilePath = $uploadDir . $cleanFileName;

                        if (file_exists($newFilePath)) {
                            $_SESSION['alert'] = "&#9940; Le fichier existe déjà. &#9940;";
                            $_SESSION['alert-color'] = 'danger';
                            header('Location: index.php?sent=views/updateFormationView&id_formation=' . $id);
                            die;
                        }

                        if (move_uploaded_file($fileTmpName, $newFilePath)) {
                            $paramsPdf = [
                                $cleanFileName,
                                $id
                            ];

                            /* *** 2.query *** */
                            $query = $connexion->prepare("
                                UPDATE formations 
                                SET fichier_horaire_pdf = ?
                                WHERE id_formation = ?
                             ");

                            /* *** 3.execute *** */
                            $query->execute($paramsPdf);

                        } else {
                            $_SESSION['alert'] = "&#9940; Erreur : Le téléchargement du fichier PDF a échoué. &#9940;";
                            $_SESSION['alert-color'] = 'danger';
                            header('Location: index.php?sent=views/updateFormationView&id_formation=' . $id);
                            die;
                        }
                    }
                    //-------PDF--------PDF--------PDF-------PDF-------PDF


                    //9. CONNEXION & QUERY
                    /* *** 2.query *** */
                    $query = $connexion->prepare("
                        UPDATE formations 
                        SET nom_formation = ?, 
                        duree_formation = ?, 
                        nom_enseignant = ?, 
                        nb_etudiants_max = ?,
                        active = ?
                        WHERE id_formation = ?
                     ");
                    /* *** 3.execute *** */
                    $query->execute($params);
                    $_SESSION['alert'] = "Formation enregistrée avec succès !";
                    $_SESSION['alert-color'] = 'success';
                    header('Location: ' . $url);
                    die;
                }
            }
        }

        if (!empty($errors)) {
            $_SESSION['alert'] = "	&#9940; &#9888;&#65039; Veuillez corriger les erreurs suivantes : " . implode('<br>', $errors);
            $_SESSION['alert-color'] = 'danger';
            header('Location: ' . $urlTwo);
            die;
        }

        /*--------------empty fields---------------*/
    } else {
        $_SESSION['alert'] = "&#9940; Veuillez choisir la formation a modifier &#9940;";
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?sent=viewFormations');
        die;
    }
} else {
    header("Location:index.php?sent=views/authLoginView");
    die;
}








