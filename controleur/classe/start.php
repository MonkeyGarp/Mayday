<?php
session_start();
require_once 'Connexion.class.php';

//ici param ok. on etablit la connexion
$db = Connexion::Connecter();
?>