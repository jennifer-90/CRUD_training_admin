<?php

// FUNCTIONS SECURITY:



/*-- 1. validateName --*/
/**
 * Valide un nom en vérifiant s'il correspond au motif spécifié.
 *
 * @param string $data Le nom à valider.
 * @return bool true si le nom est valide, false sinon.
 */
function validateName($data)
{
    $pattern = '/^[^a-zA-Z]*[a-zA-Z][a-zA-ZÀ-ÖÜà-öüÄäÉéèÈêëÎîïÌìíÍíìÑñÙùúÛûü\'_\- ]*$/';
    return preg_match($pattern, $data);
}




/*-- 2. cleanData --*/
/**
 * Nettoie les données en fonction du type spécifié (string ou int).
 *
 * @param mixed $data Les données à nettoyer.
 * @param string $type Le type de données ('string' ou 'int').
 * @return mixed Les données nettoyées.
 */
function cleanData($data, $type)
{
    if ($type === 'string') {
        $data = strip_tags(htmlspecialchars(ucfirst(strtolower(trim($data)))));
    } elseif ($type === 'int') {
        $data = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    } else {
        $_SESSION['alert'] = "&#9940; Type de données non valide. &#9940;";
        $_SESSION['alert-color'] = 'danger';
        header('Location: ' . $urlTwo);
        die;
    }
    return $data;
}




/*-- 3. validateNumber --*/
/**
 * Valide que la durée et le nombre d'étudiants ne sont pas vides ou nuls.
 *
 * @param mixed $duree La durée à valider.
 * @param mixed $etudiantMax Le nombre maximum d'étudiants à valider.
 * @return bool true si les deux valeurs sont valides, false sinon.
 */
function validateNumber($duree, $etudiantMax) {
    if (empty($duree) || $etudiantMax === 0) {
        return false;
    } else {
        return true;
    }
}




/*-- 4. checkUniqueFormationName --*/ // app/addFormation
/**
 * Vérifie si un nom de formation est unique lors de l'ajout d'une nouvelle formation.
 *
 * @param string $name Le nom de la formation à vérifier.
 * @return bool true si le nom de la formation est unique, false sinon.
 */
function checkUniqueFormationName($name) {
    global $connexion;
    $query = $connexion->prepare("SELECT COUNT(*) FROM formations WHERE nom_formation = ?");
    $query->execute([$name]);
    return $query->fetchColumn() === 0;
}




/*-- 5. checkUniqueUpdateFormationName--*/ // app/updateFormation
/**
 * Vérifie si un nom de formation est unique lors de la mise à jour d'une formation, en excluant la formation spécifique.
 *
 * @param string $name Le nom de la formation à vérifier.
 * @param int $idFormation L'ID de la formation actuelle (à exclure de la vérification).
 * @return bool true si le nom de la formation est unique, false sinon.
 */
function checkUniqueUpdateFormationName($name, $idFormation) {
    global $connexion;
    $query = $connexion->prepare("SELECT COUNT(*) FROM formations WHERE nom_formation = ? AND id_formation != ?");
    $query->execute([$name, $idFormation]);
    return $query->fetchColumn() === 0;
}