<?php
$cleModification = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
  <path d="M16 4.5a4.5 4.5 0 0 1-1.703 3.526L13 5l2.959-1.11q.04.3.041.61"/>
  <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.5 4.5 0 0 0 11.5 9m-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376M3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
</svg>';
$delete = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
  <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
</svg>';

$upload = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
</svg>';

$plus = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg>';

$pdf = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
</svg>';

/*---------------------------------------------------------------*/

if (!empty($_SESSION['name'])) {

// CONNEXION & QUERY
    /* *** 1.connexion *** */
    global $connexion;
    $connexion = connexion();

    /* *** 2.query *** */
    $sql = "SELECT * FROM formations";
    $query = $connexion->prepare($sql);

    /* *** 3.execute *** */
    $query->execute();

    /* *** 4.fetch *** */
    $result = $query->fetchAll();
    if ($result) {
        ?>
        <h1>LearnZone</h1>

        <p>Bienvenue à LearnZone, où nous proposons une variété passionnante de formations pour tous les horizons !
            Découvrez nos programmes enrichissants dispensés par une équipe d'enseignants dévoués. Voici un aperçu de
            nos
            cours actuels</p>

        <h2>NOS FORMATIONS:</h2>

        <div class="table-container">
            <a href="index.php?sent=views/addFormationView" class="add-formation-btn"><?php echo $plus ?> Ajouter une
                formation</a>
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th>Nom formation</th>
                    <th>durée formation</th>
                    <th>nom enseignant</th>
                    <th>nbre étudiants</th>
                    <th>fichier horaire</th>
                    <th>actif</th>
                    <th>modifier</th>
                    <th>upload</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($result as $formation) {

                    /*--pdf link --*/
                    $pdfLink = '';
                    if (!empty($formation['fichier_horaire_pdf'])) {

                        $fullFileName = $formation['fichier_horaire_pdf'];

                        $pdfNameToDisplay = extractPdfName($fullFileName);

                        $pdfLink = '<a href="./uploads/pdfs/' . $formation['fichier_horaire_pdf'] . '" target="_blank">' . $pdfNameToDisplay . '</a>';
                    }
                    /*----*/

                    echo '
        <tr>
            <td>' . ($formation['active'] == 1 ? '&#128994; ' : '&#128308; ') . '<a href="index.php?sent=views/formationView&id_formation=' . $formation['id_formation'] . '">' . $formation['nom_formation'] . '</a></td>
            <td>' . $formation['duree_formation'] . ' crédit(s)</td>
            <td>' . $formation['nom_enseignant'] . ' </td>
            <td>' . $formation['nb_etudiants_max'] . ' étudiant(s)</td>
            <td>' . $pdfLink . '</td>
            
            <!-- A REVOIR -->
            <td>' . ($formation['active'] == 1 ? '&#9989;' : '&#10060;') . ' </td>
            <!----------------------------->
            <td>
                <a href="index.php?sent=views/updateFormationView&id_formation=' . $formation['id_formation'] . '">' . $cleModification . '</a>
            </td>
            <td>
                <a href="index.php?sent=views/addPdfView&id_formation=' . $formation['id_formation'] . '">' . $pdf . $upload . '</a>
            </td>
        </tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }
} else {
    header("Location:index.php?sent=views/authLoginView");
}
?>

<script>
    // Fonction pour soumettre le formulaire une fois le fichier choisi
    function submitFormOnFileSelect(inputId, buttonId) {
        const input = document.getElementById(inputId);
        const button = document.getElementById(buttonId);

        input.addEventListener('change', function () {
            if (input.files.length > 0) {
                button.click(); // Clic sur le bouton de soumission
            }
        });
    }

    // Appel de la fonction lors du chargement de la page
    document.addEventListener('DOMContentLoaded', function () {
        submitFormOnFileSelect('pdfFileInput', 'submitButton');
    });
</script>
