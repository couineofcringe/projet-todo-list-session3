
<?php
require 'connexion.php';

// Vider la corbeille
if (isset($_GET['action']) && $_GET['action'] === 'vider_corbeille') {
    
    // Suppression définitive
    $sql = "DELETE FROM taches WHERE status = 'deleted'";
    $stmt = $pdo->query($sql);
    
    // Retour sur home
    header('Location: index.php');
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    
    $id = $_GET['id'];
    $new_status = $_GET['status'];

    // Ajouter 'deleted' à la liste des status
    $allowed_statuses = ['todo', 'progress', 'done', 'deleted'];

    if (in_array($new_status, $allowed_statuses)) {
        
        if ($new_status === 'deleted') {
            // CAS 1 : Mise à la poubelle -> On change le status ET on note la date
            $sql = "UPDATE taches SET statut = :statut, date_deleted = NOW() WHERE id = :id";
        } else {
            // CAS 2 : Restauration ou autre -> On change le status ET on efface la date
            $sql = "UPDATE taches SET statut = :statut, date_deleted = NULL WHERE id = :id";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':statut' => $new_status,
            ':id' => $id
        ]);
    }
}
// Retour home
header('Location: index.php');
exit();
?>