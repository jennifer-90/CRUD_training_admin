<?php
$plus = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
</svg>';

$retour = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
</svg>';

$panneau = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-signpost-fill" viewBox="0 0 16 16">
  <path d="M7.293.707A1 1 0 0 0 7 1.414V4H2a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h5v6h2v-6h3.532a1 1 0 0 0 .768-.36l1.933-2.32a.5.5 0 0 0 0-.64L13.3 4.36a1 1 0 0 0-.768-.36H9V1.414A1 1 0 0 0 7.293.707"/>
</svg>';
/*---------------------------------------------------------------*/
if (!empty($_SESSION['name'])) {
    ?>

    <div class="container">
        <img src="picturesWeb/logo.png" class="logo" alt="Logo">
        <h2>AJOUTER UNE FORMATION A LEARNZONE <?php echo $panneau ?></h2><br>
        <form action="index.php?sent=app/addFormation" method="post" enctype="multipart/form-data">
            <div>
                <input class="form-control" type="text" name="name" placeholder="Nom de la nouvelle formation"><br>
                <input class="form-control" type="number" name="duree" placeholder="Durée de la formation"><br>
                <input class="form-control" type="text" name="enseignant" placeholder="Nom de l'enseignant"><br>
                <input class="form-control" type="number" name="etudiantMax"
                       placeholder="Nombre d'étudiant maximum à cette formation">

                <input type="file" name="pdfFile" id="pdf_fileP" accept="application/pdf">
                <label for="pdf_fileP" class="labelP">Choisir un fichier pdf</label>
                <small>* Horaire de la formation</small>
                <br>

                <input class="form-check-input" type="checkbox" name="active" checked>
                <small> &nbsp;* Actif</small><br><br>

            </div>
            <div>
                <button class="btn btn-primary" type="submit">
                    <?php echo $plus ?>
                    AJOUTER
                </button>
                <br>
                <button class="btn btn-primary"><a href="index.php?sent=views/arrayFormations">
                        <?php echo $retour ?>
                        RETOUR
                    </a></button>
            </div>
        </form>
    </div>
    <?php
} else {
    header("Location:index.php?sent=views/authLoginView");
}