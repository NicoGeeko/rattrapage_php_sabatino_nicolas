<?php

session_start();
//imports
include "utils/tool.php";
include "env.php";
include "utils/bdd.php";
include "model/note.php";
//test si l'utilisateur n'est pas connecté
if (!isset($_SESSION["connected"])) {
    header("Location: index.php");
}

$idUser = $_SESSION["idUser"];

$notes = findAllNote($idUser);

?>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/style.css">
    <title>Liste des Notes</title>
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
        <h2>Liste des Notes</h2>
        <table >
            <thead>
                <th>Nom de la Note</th>
                <th>contenu</th>
                <th>Date de publication</th>
            </thead>
            
            <?php foreach ($notes as $note): ?>
                <tr>
                    <td><?= $note["title"] ?> </td>
                    <td>
                        <?= $note["content"] ?>
                    </td>

                    <td>
                        <?= $note["created_at"] ?>
                    </td>

                </tr>
            <?php endforeach ?>
        </table>
    </main>
</body>

</html>