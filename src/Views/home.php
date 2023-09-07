<main class="">
    <?php
    echo '<h2>' . $titlePage . '</h2>';
    if ($isConnected) {
        echo '<h3>Projet dirigés :</h3>';
        foreach ($projetsDirected as $projet) {
            echo 'id : ' . $projet->getId_projet()
                . ' / nom : ' . $projet->getTitre()
                . ' / description : ' . $projet->getDescription()
                . ' / id_directeur : ' . $projet->getId_utilisateur()
                . '<br />';
        }
    } else {
        echo '<h4>Veuillez vous connecter</h4>';
    }
    ?>
</main>