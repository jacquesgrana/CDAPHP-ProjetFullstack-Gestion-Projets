<main>
    <?php
    echo '<h2>' . $titlePage . '</h2>';

    if ($isConnected) {
        echo '<h3>Affichage de la tâche</h3>';
    } else {
        echo '<h3>Veuillez vous connecter</h3>';
    }
    ?>
</main>