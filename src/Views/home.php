<main class="main">
    <?php
    echo '<h2>' . $titlePage . '</h2>';
    if ($isConnected) {
        /*
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
        }*/

        if (count($projetsDirected) > 0) {
            echo '<h3>Projet(s) dirigé(s) :</h3>';
            echo '<table>';
            echo '<tr><th>ID</th><th>Nom</th><th>Description</th><th>ID Directeur</th><th>Actions</th></tr>';
            foreach ($projetsDirected as $projet) {
                echo '<tr>'
                    . '<td>' . $projet->getId_projet() . '</td>'
                    . '<td>' . $projet->getTitre() . '</td>'
                    . '<td>' . $projet->getDescription() . '</td>'
                    . '<td>' . $projet->getId_utilisateur() . '</td>'
                    . '<td>'
                    . '<a href="index.php?page=Projet&method=view&id=' 
                    . $projet->getId_projet()
                    . '&token=' . $token
                    . '" class="btn-01-sm-blue">&#128196; Voir</a>'
                   
                    . '<a href="index.php?page=Projet&method=edit&id=' 
                    . $projet->getId_projet() 
                    . '&token=' . $token
                    . '" class="btn-01-sm">&#9998; Modifier</a>'
                    
                    . '<a href="index.php?page=Home&method=deleteProjet&id=' . $projet->getId_projet() 
                    . '&token=' . $token
                    . '" class="btn-01-sm-red" onclick="return confirm(\'Voulez-vous supprimer ce projet ?\')">X Supprimer</a>'
                    . '</td>'
                    . '</tr>';
            }
            echo '</table>';
        }
        
        if (count($projetsParticip) > 0) {
            echo '<h3>Projet(s) avec participation :</h3>';
            echo '<table>';
            echo '<tr><th>ID</th><th>Nom</th><th>Description</th><th>ID Directeur</th><th>Actions</th></tr>';
            foreach ($projetsParticip as $projet) {
                echo '<tr>'
                    . '<td>' . $projet->getId_projet() . '</td>'
                    . '<td>' . $projet->getTitre() . '</td>'
                    . '<td>' . $projet->getDescription() . '</td>'
                    . '<td>' . $projet->getId_utilisateur() . '</td>'
                    . '<td>'
                    . '<a href="index.php?page=Projet&method=view&id=' 
                    . $projet->getId_projet() 
                    . '&token=' . $token
                    . '" class="btn-01-sm-blue">&#128196; Voir</a>'
                    . '</td>'
                    . '</tr>';
            }
            echo '</table>';
        }
        

        echo '<br />';
        echo '<a href="index.php?page=Projet&method=create&token=' . $token . '" class="btn-01  btn-space-01">Créer un projet</a>';
    } else {
        echo '<h3>Veuillez vous connecter</h3>';
        echo '<p><a class="link01" href="./index.php?page=Connexion&method=index">Connectez-vous</a></p>';

    }
    ?>
    <!--<div id="bloc-grow">-->
        
    </div>
</main>