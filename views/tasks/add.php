<?php require_once 'views/templates/header.php'; ?>

<h2>Ajouter une tâche</h2>

<div class="form-container">
    <form action="index.php?page=add" method="POST">
        <div class="form-group">
            <label for="title">Titre <span class="required">*</span></label>
            <input type="text" name="title" id="title" value="<?php echo isset($data['title']) ? $data['title'] : ''; ?>" class="<?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>">
            <span class="invalid-feedback"><?php echo isset($data['title_err']) ? $data['title_err'] : ''; ?></span>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description"><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="status">Statut</label>
            <select name="status" id="status">
                <option value="non terminé" <?php echo ($data['status'] == 'non terminé') ? 'selected' : ''; ?>>Non terminé</option>
                <option value="en cours" <?php echo ($data['status'] == 'en cours') ? 'selected' : ''; ?>>En cours</option>
                <option value="terminé" <?php echo ($data['status'] == 'terminé') ? 'selected' : ''; ?>>Terminé</option>
            </select>
        </div>
        
        <div class="form-group">
            <input type="submit" value="Ajouter" class="btn submit">
            <a href="<?php echo BASE_URL; ?>" class="btn back">Annuler</a>
        </div>
    </form>
</div>

<?php require_once 'views/templates/footer.php'; ?> 