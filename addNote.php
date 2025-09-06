<?php

session_start();

include "utils/tool.php";
include "env.php";
include "utils/bdd.php";
include "model/note.php";


$message = addNote();

function addNote(): string
{
    
    if (!isset($_SESSION["connected"])) {
        header("Location: index.php");
    }

    
    if (isset($_POST["submit"])) {
        
        if (
            !empty($_POST["title"]) && !empty($_POST["content"]) && !empty($_POST["created_at"])

        ) {
            
            $idUser = sanitize($_SESSION["idUser"]);
            //nettoyage des informations de la note (formulaire)
            $title = sanitize($_POST["title"]);
            $content = sanitize($_POST["content"]);
            $createdAt = sanitize($_POST["created_at"]);
            
            $note = [];
            $note["title"] = $title;
            $note["idUser"] = $idUser;
            $note["content"] = $content;
            $note["created_at"] = $createdAt;

            
            saveNote($note);
            return "La note a été ajoutée en BDD";
        } else {
            return "Veuillez remplir tous les champs du formulaire";
        }
    }
    return "";
}

?>


<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <title>Ajouter une note</title>
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

    <main >
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Ajouter une note au Bloc Notes</h2>
            <p class="error"><?= $message ?? "" ?></p>
            <input type="text" name="title" placeholder="saisir la note" require>
            <textarea name="content" rows="5" cols="30" placeholder="saisir le contenu de la note" require></textarea>
            <label for="created_at">Saisir la date de publication de la note</label>
            <input type="date" name="created_at" require>

            <input type="submit" value="Ajouter" name="submit">
        </form>
    </main>
</body>

</html>
