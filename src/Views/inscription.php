<main class="main">
    <h2><?= $titlePage ?></h2>
    <?php
        echo '<form action="index.php?page=Inscription&method=create" method="POST">';
        echo '<div>';
        echo '<label for="nom">Nom : </label>';
        echo '<input type="text" placeholder="Saisir votre nom" name="nom" id="nom">';
        echo '</div>';
        echo '<div>';
        echo '<label for="prenom">Prénom : </label>';
        echo '<input type="text" placeholder="Saisir votre prénom" name="prenom" id="prenom">';
        echo '</div>';
        echo '<div>';
        echo '<label for="email">Email : </label>';
        echo '<input type="email" placeholder="Saisir votre email" name="email" id="email">';
        echo '</div>';
        echo '<div>';
        echo '<label for="mdp">Mot de Passe : </label>';
        echo '<input type="password" placeholder="Saisir votre mot de passe" name="mdp" id="mdp">';
        echo '<input type="hidden" name="connexion" value="create">';
        echo '</div>';
        echo '<div>';
        echo '<button class="btn-01 bg-color01-02" type="submit">Valider</button>';
        echo '</div>';
        echo '</form>';
    ?>
</main>