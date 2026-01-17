<?php
require 'connexion.php';

// Gestion des tâches supprimées ('deleted')
// Suppression définitive de la BDD depuis plus de 30 jours
$sql_purge = "DELETE FROM taches WHERE statut = 'deleted' AND date_deleted < (NOW() - INTERVAL 30 DAY)";
$pdo->query($sql_purge);

// Restaurer : Récupérer les tâches supprimées
$sql = "SELECT * FROM taches ORDER BY date_creation DESC";
$stmt = $pdo->query($sql);
$toutes_les_taches = $stmt->fetchAll();

// Tri des tâches (répartition dans des tableaux)
$todo = [];
$progress = [];
$done = [];
$deleted = []; 

foreach ($toutes_les_taches as $tache) {
    if ($tache['statut'] === 'todo') {
        $todo[] = $tache;
    } elseif ($tache['statut'] === 'progress') {
        $progress[] = $tache;
    } elseif ($tache['statut'] === 'done') {
        $done[] = $tache;
    } elseif ($tache['statut'] === 'deleted') {
        $deleted[] = $tache;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Todo List Perso</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="all_variables.css">
</head>
<body>

    <h1>Ma Gestion de Tâches</h1>

    <div class="main-layout">
        <section class="layout-form">
            <div class="form-container">
                <h2>Ajouter une tâche</h2>
                <form action="traitement.php" method="POST">
                    <label for="titre">Nom de la tâche :</label>
                    <input type="text" name="titre" id="titre" required placeholder="Ex: Acheter du pain">

                    <label for="categorie">Catégorie :</label>
                    <select name="categorie" id="categorie">
                        <option value="Personnel">Personnel</option>
                        <option value="Cours">Cours</option>
                        <option value="Stage">Stage</option>
                        <option value="Administratif">Administratif</option>
                        <option value="Paiement">Paiement</option>
                    </select>

                    <label for="description">Description détaillée :</label>
                    <textarea name="description" id="description" rows="3" placeholder="Détails de la tâche..."></textarea>

                    <button type="submit">Créer la tâche</button>
                </form>
            </div>
        </section>
    
        <section class="layout-board">
            <h2>Mon Tableau de Bord</h2>

            <div class="kanban-board">
    
                <div class="column">
                    <h3>À Faire (<?php echo count($todo); ?>)</h3>
                        <?php foreach ($todo as $tache): ?>
                        <div class="task-card">
                            <strong><?php echo htmlspecialchars($tache['titre']); ?></strong>
                            <p><?php echo nl2br(htmlspecialchars($tache['description'])); ?></p>
                            <small class="task-cat"><?php echo htmlspecialchars($tache['categorie']); ?></small>
                
                            <div class="task-actions">
                                <a href="update.php?id=<?php echo $tache['id']; ?>&status=progress" class="btn-action-prim btn-go">Commencer</a>
                                <a href="update.php?id=<?php echo $tache['id']; ?>&status=deleted" class="btn-icon-delete" title="Supprimer">
                                <span class="material-icons">delete_outline</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="column">
                    <h3>En Cours (<?php echo count($progress); ?>)</h3>
                    <?php foreach ($progress as $tache): ?>
                    <div class="task-card">
                        <strong><?php echo htmlspecialchars($tache['titre']); ?></strong>
                        <p><?php echo nl2br(htmlspecialchars($tache['description'])); ?></p>
                        <small class="task-cat"><?php echo htmlspecialchars($tache['categorie']); ?></small>
                
                        <div class="task-actions">
                            <a href="update.php?id=<?php echo $tache['id']; ?>&status=todo" class="btn-action-sec">Retour</a>
                            <a href="update.php?id=<?php echo $tache['id']; ?>&status=done" class="btn-action-prim btn-done">Done !</a>
                            <a href="update.php?id=<?php echo $tache['id']; ?>&status=deleted" class="btn-icon-delete" title="Supprimer">
                            <span class="material-icons">delete_outline</span>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="column">
                    <h3>Terminé (<?php echo count($done); ?>)</h3>
                    <?php foreach ($done as $tache): ?>
                    <div class="task-card" >
                        <strike><strong><?php echo htmlspecialchars($tache['titre']); ?></strong></strike>
                
                        <div class="task-actions">
                            <a href="update.php?id=<?php echo $tache['id']; ?>&status=progress" class="btn-action-prim btn-redo">
                            Oups ! Not done :/
                            </a>
                            <a href="update.php?id=<?php echo $tache['id']; ?>&status=deleted" class="btn-icon-delete" title="Supprimer">
                            <span class="material-icons">delete_outline</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
    <section class="layout-trash">
    <div class="header-trash">
    
    <h2>Corbeille <span class="title-muted">(Suppression automatique J+30)</span></h2>
    
    <?php if (count($deleted) > 0): ?>
        <a href="update.php?action=vider_corbeille" 
           class="btn-vider" 
           onclick="return confirm('Attention ! Cette action est irréversible. Vider la corbeille ?');">
           <span class="material-icons">delete_forever</span>
           Tout vider
        </a>
    <?php endif; ?>

</div>
    
    <div> 
        
        <?php if (count($deleted) > 0): ?>
            <?php foreach ($deleted as $tache): ?>
                <div class="task-card">
                    <div class="info-deleted">
                        <div>
                            <strong><?php echo htmlspecialchars($tache['titre']); ?></strong>
                            <span class="muted"> 
                                (Supprimé le : <?php echo date("d/m/Y à H:i", strtotime($tache['date_deleted'])); ?>)
                            </span>
                        </div>
                        
                        <div class="task-actions">
                            <a href="update.php?id=<?php echo $tache['id']; ?>&status=todo" class="btn-action-sec restaurer">
                                Restaurer
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="muted">La corbeille est vide.</p>
        <?php endif; ?>

    </div>
</section>
</body>
</html>