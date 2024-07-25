<?php


function connexion()
{
    global $connexion;

    if (is_a($connexion, 'PDO')) {
        return $connexion;
    } else {
        try {
            $connexion = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8mb4', DB_USER, DB_PWD);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
        return $connexion;
    }
}



