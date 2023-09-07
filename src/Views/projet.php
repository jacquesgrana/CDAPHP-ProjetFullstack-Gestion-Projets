<main>
    <?php
    echo '<h2>' . $titlePage . '</h2>';

    if ($isConnected) {
        echo '<h3>Affichage du projet</h3>';
        // modifier selon le mode
        if($mode === 'edit') {
            echo '<form action="/index.php?page=Projet&method=update" method="POST">';
        }
        else {
            echo '<form action="/index.php?page=Projet" method="POST">';
        }
        echo '<div>';
        echo '<label for="id_projet">Id projet : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_projet" id="id_projet" disabled="disabled" value="' . (($mode !== 'create') ? $projet->getId_projet() : '' ) . '">';
        echo '</div>';
        echo '<div>';
        echo '<label for="titre">Titre : </label>';
        echo '<input type="text" placeholder="Saisir un titre" name="titre" id="titre" value="' . (($mode !== 'create') ? $projet->getTitre() : '' ) . '">';
        //echo '<input type="hidden" name="connexion" value="connect">';
        echo '</div>';
        echo '<div>';
        echo '<label for="description">Description : </label>';
        echo '<input type="text" placeholder="Saisir une description" name="description" id="description" value="' . (($mode !== 'create') ? $projet->getDescription() : '' ) . '">';
        echo '</div>';
        echo '<div>';
        echo '<label for="id_utilisateur">Id directeur : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_utilisateur" id="id_utilisateur" disabled="disabled" value="' . (($mode !== 'create') ? $projet->getId_utilisateur() : '' ) . '">';
        echo '</div>';
        echo '<div>';
        if($mode !== 'view') echo '<button type="submit">&#10004; Valider</button>';
        echo '<button class="" formaction="/index.php?page=Home&method=index">&#10226; Retour</button>';
        echo '</div>';
        echo '</form>';
        //var_dump($projet);
    }
    else {
        echo '<h3>Veuillez vous connecter</h3>';
    }
    ?>
</main>