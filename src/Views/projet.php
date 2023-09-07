<main>
    <?php
    echo '<h2>' . $titlePage . '</h2>';

    if ($isConnected) {
        echo '<h3>Affichage du projet</h3>';
        // modifier selon le mode
        if ($mode === 'edit') {
            echo '<form action="/index.php?page=Projet&method=update" method="POST">';
        }
        if ($mode === 'create') {
            echo '<form action="/index.php?page=Projet&method=create" method="POST">';
        } else {
            echo '<form action="/index.php?page=Projet" method="POST">';
        }
        echo '<div>';
        echo '<label for="id_projet">Id projet : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_projet" id="id_projet" disabled="disabled" value="' . (($mode !== 'create') ? $projet->getId_projet() : '') . '">';
        echo '</div>';
        echo '<div>';
        echo '<label for="titre">Titre : </label>';
        echo '<input type="text" placeholder="Saisir un titre" name="titre" id="titre" value="' . (($mode !== 'create') ? $projet->getTitre() : '') . '">';
        //echo '<input type="hidden" name="connexion" value="connect">';
        echo '</div>';
        echo '<div>';
        echo '<label for="description">Description : </label>';
        echo '<input type="text" placeholder="Saisir une description" name="description" id="description" value="' . (($mode !== 'create') ? $projet->getDescription() : '') . '">';
        echo '</div>';
        echo '<div>';
        echo '<label for="id_utilisateur">Id directeur : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_utilisateur" id="id_utilisateur" disabled="disabled" value="' . (($mode !== 'create') ? $projet->getId_utilisateur() : $_SESSION['user_id']) . '">';
        echo '</div>';
        echo '<div>';
        if ($mode !== 'view') echo '<button type="submit">&#10004; Valider</button>';
        echo '<button class="" formaction="/index.php?page=Home&method=index">&#10226; Retour</button>';
        echo '</div>';
        echo '</form>';
        //var_dump($projet);
        /*
        if(count($taches) > 0) {
            echo '<h3>Tache(s) associée(s)</h3>';
            //var_dump($taches);
            foreach($taches as $t) {
                echo '<p>' 
                . $t->getId_tache()
                . ' / '
                . $t->getNom()
                . ' / '
                . $t->getDescription()
                . ' / '
                . $t->getId_utilisateur()
                . ' / '
                . $t->getId_statut()
                . ' / '
                . $t->getId_priorite()
                . ' / '
                . $t->getId_projet()
                . '</p>';
            }

            var_dump($tachesAll);
        }*/

        if (count($tachesAll) > 0) {
            echo '<h3>Tache(s) associée(s)</h3>';
            foreach ($tachesAll as $t) {
                echo '<p>'
                    . $t->id_tache
                    . ' / '
                    . $t->nom
                    . ' / '
                    . $t->description
                    . ' / '
                    . $t->nom . ' : ' . $t->prenom
                    . ' / '
                    . $t->statut
                    . ' / '
                    . $t->priorite
                    . ' / '
                    . '<a href="index.php?page=Tache&method=view&id='
                    . $projet->getId_projet()
                    . '">Voir</a>';
   

                if ($mode !== 'view') {
                    echo ' / '
                    . '<a href="index.php?page=Tache&method=edit&id='
                    . $projet->getId_projet()
                    . '">Editer</a>'
                    . ' / '
                    . '<a href="index.php?page=Projet&method=delete&id='
                    . $projet->getId_projet()
                    . '">Supprimer</a>';
                }
                echo '</p>';
            }
        }
        if ($mode !== 'view') {
            echo '<br />';
            echo '<a href="index.php?page=Tache&method=create">Créer une tâche</a>';
        }
    } else {
        echo '<h3>Veuillez vous connecter</h3>';
    }
    ?>
</main>