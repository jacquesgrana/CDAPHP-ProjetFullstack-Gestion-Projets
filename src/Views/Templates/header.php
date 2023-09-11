<body>
<header class="d-flex flex-column align-items-center bg-color01-02">
    <h1 class="">Gestion de Projets</h1>
    <?php if ($isConnected) {
        echo '<div class="d-flex justify-content-center flex-wrap align-items-center"><p>' . $_SESSION['user_firstname'] .  ' <span class="color02-04">•</span> ' . $_SESSION['user_lastname'].  ' <span class="color02-04">•</span> ' . $_SESSION['user_email'] . '</p>';
        echo '<a class="btn-02" href="index.php?page=Home&method=disconnect" onclick="return confirm(\'Voulez-vous vous déconnecter ?\')">Déconnecter</a></div>';
    } ?>
    <nav class="d-flex justify-content-center flex-wrap" id="nav">
        <ul class="d-flex gap-3 justify-content-center">
        <li class='li-nav'>
        <a class='btn-01' href='./index.php?page=Home&method=index'>Accueil</a>
        </li>
        <li class='li-nav'>
        <a class='btn-01' href='./index.php?page=Connexion&method=index'>Connexion</a>
        </li>
        <li class='li-nav'>
            <a class='btn-01' href='./index.php?page=Inscription&method=index'>Inscription</a>
            </li>
        </ul>
    </nav>
</header>