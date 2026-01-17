<?php

require 'connexion.php';

// Vérifier envoir formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['titre'])) {

    // Récupérer data
    $titre = trim($_POST['titre']);
    $categorie = $_POST['categorie'];
    $description = trim($_POST['description']);

    // SQL request : préparée (pour protéger BDD) 
    $sql = "INSERT INTO taches (titre, categorie, description, statut, date_creation) 
            VALUES (:titre, :categorie, :description, 'todo', NOW())";
    
    $stmt = $pdo->prepare($sql);

    // Exécute : data
    try {
        $stmt->execute([
            ':titre' => $titre,
            ':categorie' => $categorie,
            ':description' => $description
        ]);

        // Rediriger vers home
        header('Location: index.php');
        exit();

    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout : " . $e->getMessage();
    }

} else {
    // Si le formulaire n'est pas rempli mais clic sur submit
    echo "Veuillez remplir le formulaire.";
}
?>