<?php

$retour = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
</svg>';


if (!empty($_SESSION['name'])) {

// Vérification de l'ID de formation
    if (!isset($_GET['id_formation'])) {
        echo "ID de formation manquant.";
        exit;
    }

    $id_formation = intval($_GET['id_formation']);

// Récupération des détails de la formation
    global $connexion;
    $query = $connexion->prepare("SELECT * FROM formations WHERE id_formation = ?");
    $query->execute([$id_formation]);
    $formation = $query->fetch(PDO::FETCH_ASSOC);

    if (!$formation) {
        echo "Formation non trouvée.";
        exit;
    }
    ?>

    <div class="container">
        <h2>* * * <?php echo strtoupper($formation['nom_formation']); ?> * * *</h2><br>
        <div class="formation-details">
            <div class="formation-info">
                <p><strong>Durée:</strong>&#x23F3; <?php echo $formation['duree_formation']; ?> crédit(s)</p>
                <p><strong>Enseignant:</strong> &#128100; <?php echo $formation['nom_enseignant']; ?></p>
                <p>
                    <strong>Fichier Horaire:</strong>
                    <?php if (!empty($formation['fichier_horaire_pdf'])): ?>

                        &#9989; <a
                                href="./uploads/pdfs/<?php echo htmlspecialchars($formation['fichier_horaire_pdf']); ?>"
                                target="_blank" download> Télécharger le fichier horaire</a><br>

                        &#9989;<a href="uploads/pdfs/<?php echo $formation['fichier_horaire_pdf']; ?>" target="_blank">Voir
                            le
                            PDF actuel
                        </a>
                    <?php else: ?>
                        &#10060; Aucun fichier horaire disponible.
                    <?php endif; ?>
                </p>
            </div>
            <div class="formation-description">
                <p><strong>Description:</strong></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eu erat lacus, consectetur
                    malesuada arcu. Morbi scelerisque, leo et vehicula auctor, felis velit vehicula eros, at congue
                    libero ante a libero.</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce quis mauris sit amet metus tempor
                    gravida. In vitae turpis sit amet nulla tristique suscipit. Proin vel quam ut libero viverra
                    feugiat. Integer auctor magna vel lacus commodo, a facilisis velit dignissim. Sed vehicula quam nec
                    massa pulvinar, in porttitor orci tincidunt.</p>
            </div>


        </div>
        <br>
        <button class="btn btn-primary"><a href="index.php?sent=views/arrayFormations">
                <?php echo $retour ?>
                RETOUR
            </a></button>
    </div>

    <?php
} else {
    echo "Vous devez être connecté et avoir sélectionné une formation.";
    header("Location:index.php?sent=views/authLoginView");
    die;
}