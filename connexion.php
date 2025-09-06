<?php

session_start();

include "utils/tool.php";
include "env.php";
include "utils/bdd.php";
include "model/user.php";
$message = connexion();


function connexion() {
    
    if (isset($_POST["submit"])) {
        
        if (!empty($_POST["email"]) && !empty($_POST["password"])) {
            
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);
            
            if (isUserExistByEmail($email)) {
                
                $user = findUserByEmail($email);
                
                if (password_verify($password, $user["password"])) {
                    
                    $_SESSION["idUser"] = $user["idUser"];
                    $_SESSION["connected"] = true;
                    
                    header('Location: index.php');
                } 
            }
            return "les informations de connexion sont incorrectes";
        } else {
            return "Veuillez remplir tous les champs de formulaire";
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
    <title>Connexion</title>
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

        <form action="" method="post">
            <h2>Se connecter</h2>
            <input type="email" name="email" placeholder="saisir le mail" require>
            <input type="password" name="password" placeholder="saisir le mot de passe" require>
            <input type="submit" value="connexion" name="submit">
            <p class="error"><?=$message??""?></p>
        </form>
    </main>
</body>

</html>