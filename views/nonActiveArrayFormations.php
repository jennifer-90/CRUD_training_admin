<?php

if (!empty($_SESSION['name'])) {

// CONNEXION & QUERY
    /* *** 1.connexion *** */
    global $connexion;
    $connexion = connexion();

    /* *** 2.query *** */
    $sql = "SELECT * FROM formations WHERE active = 0";
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
            nos cours actuels :</p>

        <h2>FORMATION(S) NON ACTIVE(S) :</h2>
        <div class="table-container">
            <br>
            <table class="table">
                <thead>
                <tr>
                    <th>Nom formation</th>
                    <th>Durée formation</th>
                    <th>Nom enseignant</th>
                    <th>Nbre étudiants</th>
                    <th>Fichier horaire</th>
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
            <td>' . ($formation['active'] == 1 ? '&#128994; ' : '&#128308; ') . ' <a href="index.php?sent=views/formationView&id_formation=' . $formation['id_formation'] . '">' . $formation['nom_formation'] . '</a></td>
            <td>' . $formation['duree_formation'] . ' crédit(s)</td>
            <td>' . $formation['nom_enseignant'] . ' </td>
            <td>' . $formation['nb_etudiants_max'] . ' étudiant(s)</td>
            <td>' . $pdfLink . '</td> 
        </tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        echo "<p><br>&#10060; Toutes nos formations sont actuellement disponibles et aucune n'est inactive.&#10060;</p>";
    }
} else {
    header("Location:index.php?sent=views/authLoginView");
}
?>

