<main class="">
    <?php
    echo '<h2>' . $titlePage . '</h2>';
    if ($isConnected) {
        if (count($projetsDirected) > 0) {
            echo '<h3>Projet dirigés :</h3>';
            foreach ($projetsDirected as $projet) {
                echo 'id : ' . $projet->getId_projet()
                    . ' / nom : ' . $projet->getTitre()
                    . ' / description : ' . $projet->getDescription()
                    . ' / id_directeur : ' . $projet->getId_utilisateur()
                    . ' / '
                    . '<a href="index.php?page=Projet&method=view&id='
                    . $projet->getId_projet()
                    . '">&#128196; Voir</a>'
                    . ' / '
                    . '<a href="index.php?page=Projet&method=edit&id='
                    . $projet->getId_projet()
                    . '">&#9998; Editer</a>'
                    . ' / '
                    . '<a href="index.php?page=Home&method=deleteProjet&id='
                    . $projet->getId_projet()
                    . '">X Supprimer</a>'
                    . '<br />';
            }
        }
        if (count($projetsParticip) > 0) {
            echo '<h3>Projet avec participation :</h3>';
            foreach ($projetsParticip as $projet) {
                echo 'id : ' . $projet->getId_projet()
                    . ' / nom : ' . $projet->getTitre()
                    . ' / description : ' . $projet->getDescription()
                    . ' / id_directeur : ' . $projet->getId_utilisateur()
                    . ' / '
                    . '<a href="index.php?page=Projet&method=view&id='
                    . $projet->getId_projet()
                    . '">&#128196; Voir</a>'
                    . '<br />';
            }
        }
        echo '<br />';
        echo '<a href="index.php?page=Projet&method=create">Créer un projet</a>';
    } else {
        echo '<h3>Veuillez vous connecter</h3>';
    }
    ?>
</main>