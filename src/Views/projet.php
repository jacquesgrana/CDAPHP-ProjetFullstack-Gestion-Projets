<main>
    <?php
    echo '<h2>' . $titlePage . '</h2>';

    if ($isConnected) {
        echo '<h3>Affichage du projet</h3>';
        // modifier selon le mode
        if($mode === 'edit') {
            echo '<form action="index.php?page=Projet&method=update" method="POST">';
        }
        else {
            echo '<form action="index.php?page=Projet" method="POST">';
        }
        echo '<div>';
        echo '<label for="id_projet">Id projet : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_projet" id="id_projet" disabled="disabled">';
        echo '</div>';
        echo '<div>';
        echo '<label for="titre">Titre : </label>';
        echo '<input type="text" placeholder="Saisir un titre" name="titre" id="titre">';
        //echo '<input type="hidden" name="connexion" value="connect">';
        echo '</div>';
        echo '<div>';
        echo '<label for="description">Description : </label>';
        echo '<input type="text" placeholder="Saisir une description" name="description" id="description">';
        echo '</div>';
        echo '<div>';
        echo '<label for="id_utilisateur">Id utilisateur : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_utilisateur" id="id_utilisateur" disabled="disabled">';
        echo '</div>';
        echo '<div>';
        echo '<button type="submit">Valider</button>';
        echo '</div>';
        echo '</form>';
        var_dump($projet);
    }
    else {
        echo '<h3>Veuillez vous connecter</h3>';
    }
    ?>
</main>