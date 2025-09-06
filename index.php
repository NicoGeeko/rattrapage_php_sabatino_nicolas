<?php
    //demarrage de la session
    session_start();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <title>Accueil</title>
</head>
<body>
    <header >
        <nav>
                <!-- Menu commun -->
                
                <a href="index.php" data-tooltip="Page Accueil">Accueil</a>   
            
                <!-- Menu connecté -->
                <?php if (isset($_SESSION["connected"])) :?>
            
                <a href="showAllNote.php" data-tooltip="Profil">Afficher liste de notes</a>
                <a href="addNote.php" data-tooltip="Profil">Ajouter une note</a>
                <a href="deconnexion.php" data-tooltip="Déconnexion">deconnexion</a>
                <?php else : ?>
                <!-- Menu déconnecté -->
                <a href="register.php" data-tooltip="Créer un compte">Inscription</a>
                <a href="connexion.php" data-tooltip="Se connecter">Connexion</a>
                <?php endif ?>
            
        </nav>

    </header>

    <main>
        <h2>Le Bloc Notes</h2>
    </main>
</body>
</html>