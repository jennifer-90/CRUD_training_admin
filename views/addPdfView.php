<?php
$retour = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5M10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5"/>
</svg>';

$upload = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
  <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
  <path d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z"/>
</svg>';

$pdf = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-pdf" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z"/>
</svg>';
/*---------------------------------------------------------------*/
if (!empty($_SESSION['name']) && isset($_GET['id_formation'])) {
    $idFormation = $_GET['id_formation'];
    ?>
    <br><br>
    <div>
        <div class="containerP">
            <h2>AJOUTER UN FICHIER PDF</h2><br>

            <form action="index.php?sent=app/addPdf" method="post" enctype="multipart/form-data">

                <input type="hidden" name="id_formation" value="<?php echo $idFormation; ?>">

                <input type="file" name="pdfFile" id="pdf_fileP" accept="application/pdf">
                <label for="pdf_fileP" class="labelP">Choisir un fichier pdf <?php echo $pdf ?></label>

                <br>
                <button type="submit" name="submit" class="buttonP"><?php echo $upload ?> Upload</button>
            </form>

            <div id="file-name-containerP" class="file-nameP"></div>
        </div>

        <div class="pdf-containerP">
            <embed id="pdf-viewerP" class="pdf-viewerP" type="application/pdf">
        </div>

    </div>
    <br>
    <button class="btn btn-primary"><a href="index.php?sent=views/arrayFormations">
            <?php echo $retour ?>
            RETOUR
        </a></button>

    <script>
        document.getElementById('pdf_fileP').addEventListener('change', function (event) {
            var file = event.target.files[0];
            if (file && file.type === "application/pdf") {
                var fileURL = URL.createObjectURL(file);
                document.getElementById('pdf-viewerP').src = fileURL;
                document.getElementById('file-name-containerP').innerText = 'Votre fichier : ' + file.name;
            } else {
                alert('Please select a valid PDF file.');
            }
        });
    </script>

    <?php
} else {
    echo "Vous devez être connecté et avoir sélectionné une formation.";
    header("Location:index.php?sent=views/authLoginView");
    die;
}
?>
