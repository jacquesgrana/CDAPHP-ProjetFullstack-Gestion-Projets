<main class="d-flex flex-column align-items-center justify-content-start">
    <?php
    echo '<h2>' . $titlePage . '</h2>';

    if ($isConnected) {
        echo '<h3>Affichage du projet</h3>';
        if ($mode === 'edit') {
            echo '<form action="/index.php?page=Projet&method=update&id='
                . $projet->getId_projet()
                . '" method="POST">';
        }
        if ($mode === 'create') {
            echo '<form action="/index.php?page=Projet&method=insert" method="POST">';
        } else {
            echo '<form action="/index.php?page=Projet" method="POST">';
        }
        echo '<div>';
        echo '<label for="id_projet">Id projet : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_projet" id="id_projet" disabled="disabled" value="' . (($mode !== 'create') ? $projet->getId_projet() : '') . '">';
        echo '</div>';
        echo '<div>';
        echo '<label for="titre">Titre : </label>';
        echo '<input type="text" placeholder="Saisir un titre" name="titre" id="titre" value="' . (($mode !== 'create') ? $projet->getTitre() : '')
            . '" ' . (($mode === 'view') ? "disabled='disabled'" : "") . '>';
        echo '</div>';
        echo '<div>';
        echo '<label for="description">Description : </label>';
        echo '<input type="text" placeholder="Saisir une description" name="description" id="description" value="' . (($mode !== 'create') ? $projet->getDescription() : '')
            . '" ' . (($mode === 'view') ? "disabled='disabled'" : "") . '>';
        echo '</div>';
        echo '<div>';
        echo '<label for="id_utilisateur">Id directeur : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_utilisateur" id="id_utilisateur" disabled="disabled" value="' . (($mode !== 'create') ? $projet->getId_utilisateur() : $_SESSION['user_id']) . '">';
        echo '</div>';

        echo '';
        if ($mode !== 'view') echo '<div class="d-flex justify-content-center"><button class="btn-01" type="submit" onclick="return confirm(\'Voulez-vous valider les modifications ?\')">&#10004; Valider</button></div>';
        //echo '<button class="" formaction="/index.php?page=Home&method=index">&#10226; Retour</button>';
        echo '';

        echo '</form>';
        //var_dump($projet);
        /*
        if (count($tachesAll) > 0) {
            echo '<h3>Tache(s) associée(s)</h3>';
            foreach ($tachesAll as $t) {
                echo '<p>'
                    . $t->id_tache
                    . ' / '
                    . $t->nom_tache
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
                    . $t->id_tache
                    . '">&#128196; Voir</a>';

                if ($mode !== 'view') {
                    echo ' / '
                    . '<a href="index.php?page=Tache&method=edit&id='
                    . $t->id_tache
                    . '">&#9998; Editer</a>'
                    . ' / '
                    . '<a href="index.php?page=Projet&method=deleteTache&id='
                    . $t->id_tache
                    . '">X Supprimer</a>';
                }
                echo '</p>';
            }
        }*/
        if (count($tachesAll) > 0) {
            echo '<h3>Tache(s) associée(s)</h3>';
            echo '<table>';
            echo '<tr><th>ID</th><th>Nom</th><th>Description</th><th>Utilisateur</th><th>Statut</th><th>Priorité</th><th>Actions</th></tr>';
            foreach ($tachesAll as $t) {
                echo '<tr>'
                    . '<td>' . $t->id_tache . '</td>'
                    . '<td>' . $t->nom_tache . '</td>'
                    . '<td>' . $t->description . '</td>'
                    . '<td>' . $t->nom . ' : ' . $t->prenom . '</td>'
                    . '<td>' . $t->statut . '</td>'
                    . '<td>' . $t->priorite . '</td>'
                    . '<td>'
                    . '<a href="index.php?page=Tache&method=view&id=' . $t->id_tache . '" class="btn-01-sm-blue">&#128196; Voir</a>';

                if ($mode !== 'view') {
                    echo '<a href="index.php?page=Tache&method=edit&id=' . $t->id_tache . '" class="btn-01-sm">&#9998; Modifier</a>'
                        . '<a href="index.php?page=Projet&method=deleteTache&id=' . $t->id_tache . '" class="btn-01-sm-red" onclick="return confirm(\'Voulez-vous supprimer cette tâche ?\')">X Supprimer</a>';
                }
                echo '</td></tr>';
            }
            echo '</table>';
        }

        echo '<div>';
        if ($mode === 'edit') {
            echo '<a href="/index.php?page=Tache&method=create" class="btn-01 btn-space-01">Ajouter une nouvelle tâche</a>';
        }
        echo '<a href="/index.php?page=Home&method=index" class="btn-01  btn-space-01">&#10226; Retour</a>';
        echo '</div>';
    } else {
        echo '<h3>Veuillez vous connecter</h3>';
        echo '<p><a class="link01" href="./index.php?page=Connexion&method=index">Connectez-vous</a></p>';
    }
    ?>
</main>