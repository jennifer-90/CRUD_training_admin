<?php

// Fonction pour nettoyer le nom de fichier
function sanitizeFilename($filename)
{
    $filename = preg_replace('/[^A-Za-z0-9\-_.]/', '_', $filename);
    return $filename;
}




