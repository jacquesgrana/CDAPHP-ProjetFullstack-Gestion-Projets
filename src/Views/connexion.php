<main class="main">
    <h2><?= $titlePage ?></h2>
    <?php
    if ($isConnected) {
        echo ('<h3>Vous êtes connecté</h3>');
    } else {
        echo '<form action="index.php?page=Connexion" method="POST">';
        echo '<div>';
        echo '<label for="email">Email : </label>';
        echo '<input type="email" placeholder="Saisir votre email" name="email" id="email">';
        echo '</div>';
        echo '<div>';
        echo '<label for="mdp">Mot de Passe : </label>';
        echo '<input type="password" placeholder="Saisir votre mot de passe" name="mdp" id="mdp">';
        echo '<input type="hidden" name="connexion" value="connect">';
        echo '</div>';
        echo '<div>';
        echo '<button class="btn-01 bg-color01-02" type="submit">Valider</button>';
        echo '</div>';
        echo '</form>';
    }
    ?>
</main>