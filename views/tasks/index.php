<?php require_once 'views/templates/header.php'; ?>

<h2>Liste des tâches</h2>

<div class="task-list">
    <?php if(!empty($tasks)) : ?>
        <?php foreach($tasks as $task) : ?>
            <div class="task-card">
                <div class="task-header">
                    <h3><?php echo $task->title; ?></h3>
                    <span class="status <?php echo strtolower(str_replace(' ', '-', $task->status)); ?>">
                        <?php echo $task->status; ?>
                    </span>
                </div>
                <div class="task-body">
                    <p><?php echo $task->description; ?></p>
                </div>
                <div class="task-footer">
                    <div class="date">Créée le: <?php echo date('d/m/Y', strtotime($task->created_at)); ?></div>
                    <div class="actions">
                        <a href="<?php echo BASE_URL; ?>?page=edit&id=<?php echo $task->id; ?>" class="btn edit">Modifier</a>
                        <a href="<?php echo BASE_URL; ?>?page=delete&id=<?php echo $task->id; ?>" class="btn delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche?');">Supprimer</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucune tâche pour le moment.</p>
    <?php endif; ?>
</div>

<?php require_once 'views/templates/footer.php'; ?> 