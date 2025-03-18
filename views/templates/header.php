<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1><?php echo SITE_NAME; ?></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>">Accueil</a></li>
                    <li><a href="<?php echo BASE_URL; ?>?page=add">Ajouter</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        <div class="container">
            <?php if(isset($_SESSION['success_msg'])) : ?>
                <div class="alert success">
                    <?php 
                    echo $_SESSION['success_msg']; 
                    unset($_SESSION['success_msg']);
                    ?>
                </div>
            <?php endif; ?> 