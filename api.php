<?php

require 'connexion.php';

//renvoie du JSON et pas du HTML
header('Content-Type: application/json');

// Récupérer les tâches (mais pas celles qui sont supprimées)
$sql = "SELECT * FROM taches WHERE statut != 'deleted' ORDER BY date_creation DESC";
$stmt = $pdo->query($sql);
$taches = $stmt->fetchAll();

// Convertir le tableau en format JSON
echo json_encode($taches, JSON_PRETTY_PRINT);
?>