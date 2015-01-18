<?php 
require_once '../controleur/classe/start.php';

$req = $db->query("SELECT * FROM produit");
$req->execute();
var_dump($req->fetchAll(PDO::FETCH_OBJ));

?>