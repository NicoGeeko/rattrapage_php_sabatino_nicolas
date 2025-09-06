<?php

session_start();
//imports
include "utils/tool.php";
include "env.php";
include "utils/bdd.php";
include "model/user.php";

$message = register();

function register(): string
{
    
    if (isset($_POST["submit"])) {
       
        if (!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
            //Nettoyage
            $firstname = sanitize($_POST["firstname"]);
            $lastname = sanitize($_POST["lastname"]);
            $email = sanitize($_POST["email"]);
            $password = sanitize($_POST["password"]);
            //test si le compte n'existe pas
            if (!isUserExistByEmail($email)) {
                //hash du password
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $user = [];
                $user["firstname"] = $firstname;
                $user["lastname"] = $lastname;
                $user["email"] = $email;
                $user["password"] = $hash;
                saveUser($user);
                return "le compte " . $email . " a été ajouté en BDD";
            } else {
                return "Le compte existe déja";
            }
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
    <title>s'inscrire</title>
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
            <h2>S'inscrire</h2>
            <p class="error"><?= $message ?? "" ?></p>
            <input type="text" name="firstname" placeholder="saisir le prénom" require>
            <input type="text" name="lastname" placeholder="saisir le nom" require>
            <input type="email" name="email" placeholder="saisir le mail" require>
            <input type="password" name="password" placeholder="saisir le password" require>
            <input type="submit" value="inscription" name="submit">
        </form>
    </main>
</body>

</html>