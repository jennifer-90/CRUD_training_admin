<?php

// Dans un vrai projet, les valeurs des constantes 'DB_USER' et 'DB_PWD' seront modifiées.
const DB_NAME = 'elearning';
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PWD = '';



// ACCES ADMIN
const NAME_ADMIN = 'Admin';
define("PWD_ADMIN", password_hash('admin1234', PASSWORD_DEFAULT));
