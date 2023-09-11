<main class="main">
    <h2><?= $titlePage ?></h2>
    <?php
    if ($isConnected) {
        if ($utilisateur !== null) {
            echo '<form action="" method="POST">';
            echo '<div>';
            echo '<label for="id_utilisateur">Id : </label>';
            echo '<input type="numeric" placeholder="Géré automatiquement" name="id_utilisateur" id="id_utilisateur" value="' . $utilisateur->getId_utilisateur() . '" disabled="disabled">';
            echo '</div>';
            echo '<div>';
            echo '<label for="nom">Nom : </label>';
            echo '<input type="text" placeholder="Saisir votre nom" name="nom" id="nom" value="' . $utilisateur->getNom() . '" disabled="disabled">';
            echo '</div>';
            echo '<div>';
            echo '<label for="prenom">Prénom : </label>';
            echo '<input type="text" placeholder="Saisir votre prénom" name="prenom" id="prenom" value="' . $utilisateur->getPrenom() . '" disabled="disabled">';
            echo '</div>';
            echo '<div>';
            echo '<label for="email">Email : </label>';
            echo '<input type="email" placeholder="Saisir votre email" name="email" id="email" value="' . $utilisateur->getEmail() . '" disabled="disabled">';
            echo '</div>';
            echo '<div class="d-flex justify-content-center">';
            //echo '<button class="btn-form" type="submit">&#10004; Valider</button>';
            echo '</div>';
            echo '</form>';
        }

        if ($getProUrl !== null) {
            //$url = $getUrlFct;
            echo '<div>';
            echo '<a href="' . $getProUrl . '" class="btn-01 btn-space-01">&#10226; Retour</a>';
            echo '</div>';
        }

    } else {
        echo '<h3>Veuillez vous connecter</h3>';
        echo '<p><a class="link01" href="./index.php?page=Connexion&method=index">Connectez-vous</a></p>';
    }
    ?>
</main>