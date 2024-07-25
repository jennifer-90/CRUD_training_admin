<?php

function extractPdfName($fullFileName) {
    $dashPosition = strpos($fullFileName, '-');

    if ($dashPosition !== false) {
        return substr($fullFileName, $dashPosition + 1);
    } else {
        return $fullFileName; // Si aucun tiret n'est trouvé, retourner le nom complet
    }
}
