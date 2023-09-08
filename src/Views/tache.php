<main>
    <?php
    echo '<h2>' . $titlePage . '</h2>';

    if ($isConnected) {
        //var_dump($tache);
        echo '<h3>Affichage de la tâche</h3>';
        // mettre l'id de la tache dans la requete &id=... pour l'update
        if ($mode === 'edit') {
            echo '<form action="/index.php?page=Tache&method=update&id=' 
            .  $tache->getId_tache() . '" method="POST">';
        }
        if ($mode === 'create') {
            echo '<form action="/index.php?page=Tache&method=insert" method="POST">';
        } else {
            echo '<form action="/index.php?page=Tache" method="POST">';
        }
        echo '<div>';

        // id_tache
        echo '<label for="id_tache">Id tâche : </label>';
        echo '<input type="number" placeholder="Id géré automatiquement" name="id_tache" id="id_tache" disabled="disabled" value="' . (($mode !== 'create') ? $tache->getId_tache() : '') . '">';
        echo '</div>';

        // nom
        echo '<div>';
        echo '<label for="nom">Nom : </label>';
        echo '<input type="text" placeholder="Saisir un nom" name="nom" id="nom" value="' . (($mode !== 'create') ? $tache->getNom() : '') 
        . '" '. (($mode === 'view') ? "disabled='disabled'" : "") . '>';
        echo '</div>';

        // description
        echo '<div>';
        echo '<label for="description">Description : </label>';
        echo '<input type="text" placeholder="Saisir une description" name="description" id="description" value="' . (($mode !== 'create') ? $tache->getDescription() : '') 
        . '" '. (($mode === 'view') ? "disabled='disabled'" : "") . '>';
        echo '</div>';

        // utilisateur
        if($utilisateurs !== null) {
            echo '<div>';
            echo '<label for="utilisateur">Utilisateur : </label>';
            echo '<select name="utilisateur"' . (($mode === 'view') ? 'disabled' : '') . '>';
            foreach($utilisateurs as $u) {
                echo '<option value="' . $u->getId_utilisateur() 
                . '" ' . (($mode !=='create' && $u->getId_utilisateur() === $tache->getId_utilisateur() ? 'selected' : '')) . '>';
                echo $u->getPrenom() 
                . ' ' . $u->getNom();
                // . ' ' . $u->getEmail();
                echo '</option>';
            }
            echo '</select>';
            echo '</div>';
        }

        // statut
        if($statuts !== null) {
            echo '<div>';
            echo '<label for="statut">Statut : </label>';
            echo '<select name="statut" ' . (($mode === 'view') ? 'disabled' : '') . '>';
            foreach($statuts as $s) {
                echo '<option value="' . $s->getId_statut() 
                . '" ' . (($mode !=='create' && $s->getId_statut() === $tache->getId_statut() ? 'selected' : '')) . '>';
                echo $s->getStatut();
                echo '</option>';
            }
            echo '</select>';
            echo '</div>';
        }
        // priorite
        if($priorites !== null) {
            echo '<div>';
            echo '<label for="priorite">Priorité : </label>';
            echo '<select name="priorite"' . (($mode === 'view') ? 'disabled' : '') . '>';
            foreach($priorites as $p) {
                echo '<option value="' . $p->getId_priorite() 
                . '" ' . (($mode !=='create' && $p->getId_priorite() === $tache->getId_priorite() ? 'selected' : '')) . '>';
                echo $p->getPriorite();
                echo '</option>';
            }
            echo '</select>';
            echo '</div>';
        }

        // projet
        echo '<div>';
        echo '<label for="projet">Id projet : </label>';
        echo '<input type="number" placeholder="Id géré automatiquement" name="projet" id="projet" disabled="disabled" value="' 
        . intval($_SESSION['id_projet'])
        . '">';
        echo '</div>';

        //boutons
        if ($mode !== 'view') echo '<button type="submit">&#10004; Valider</button>';
        
        // faire fonction ?
        $formaction = '/index.php?page=Projet&method=create';
        if(isset($_SESSION['id_projet']) && isset($_SESSION['mode_projet'])) {
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