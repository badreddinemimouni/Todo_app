<?php require_once 'views/templates/header.php'; ?>

<h2>Liste des tâches</h2>

<div id="add-form-container" class="form-container">
    <h3>ajouter une tâche</h3>
    <form id="add-task-form">
        <div class="form-group">
            <label for="title">Titre <span class="required">*</span></label>
            <input type="text" name="title" id="title" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
        </div>
        
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status">
                <option value="non terminé">Non terminé</option>
                <option value="en cours">En cours</option>
                <option value="terminé">Terminé</option>
            </select>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn submit">Ajouter</button>
        </div>
    </form>
</div>

<div class="task-list">
    <?php if(!empty($tasks)) : ?>
        <?php foreach($tasks as $task) : ?>
            <div class="task-card" id="task-<?php echo $task->id; ?>">
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
                        <button onclick="supprimerTache(<?php echo $task->id; ?>)" class="btn delete">Supprimer</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Aucune tâche pour le moment.</p>
    <?php endif; ?>
</div>

<!-- inclure notre fichier js -->
<script src="assets/js/app.js"></script>

<?php require_once 'views/templates/footer.php'; ?> 