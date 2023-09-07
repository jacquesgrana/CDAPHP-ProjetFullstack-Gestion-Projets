<main>
    <?php
    echo '<h2>' . $titlePage . '</h2>';

    if ($isConnected) {
        //var_dump($tache);
        echo '<h3>Affichage de la tâche</h3>';
        if ($mode === 'edit') {
            echo '<form action="/index.php?page=Tache&method=update" method="POST">';
        }
        if ($mode === 'create') {
            echo '<form action="/index.php?page=Tache&method=create" method="POST">';
        } else {
            echo '<form action="/index.php?page=Tache" method="POST">';
        }
        echo '<div>';
        echo '<label for="id_tache">Id tâche : </label>';
        echo '<input type="numeric" placeholder="Id géré automatiquement" name="id_tache" id="id_tache" disabled="disabled" value="' . (($mode !== 'create') ? $tache->getId_tache() : '') . '">';
        echo '</div>';
        echo '<div>';
        echo '<label for="nom">Description : </label>';
        echo '<input type="text" placeholder="Saisir une description" name="nom" id="nom" value="' . (($mode !== 'create') ? $tache->getNom() : '') . '">';
        echo '</div>';
        echo '<div>';
        echo '<label for="description">Description : </label>';
        echo '<input type="text" placeholder="Saisir une description" name="description" id="description" value="' . (($mode !== 'create') ? $tache->getDescription() : '') . '">';
        echo '</div>';
        echo '<div>';
        if ($mode !== 'view') echo '<button type="submit">&#10004; Valider</button>';
        // TODO modifier url !!!! selon $mode !!!
        // recuperer l'id du projet par $_SESSION['id_projet'] et faire le formaction en fonction
        $formaction = '/index.php?page=Projet&method=create';
        if(isset($_SESSION['id_projet']) && isset($_SESSION['mode_projet'])) {
            //var_dump($_SESSION['id_projet']);
            //var_dump($_SESSION['mode_projet']);

            if($_SESSION['mode_projet'] = 'edit') {
                $formaction = "/index.php?page=Projet&method=edit&id=" . $_SESSION['id_projet'];
            }
            elseif($_SESSION['mode_projet'] = 'view') {
                $formaction = "/index.php?page=Projet&method=view&id=" . $_SESSION['id_projet'];
            }
        }
        //echo $formaction;
        echo '<button class="" formaction="' . $formaction . '">&#10226; Retour</button>';
        echo '</div>';
        echo '</form>';
        
    } else {
        echo '<h3>Veuillez vous connecter</h3>';
    }
    ?>
</main>