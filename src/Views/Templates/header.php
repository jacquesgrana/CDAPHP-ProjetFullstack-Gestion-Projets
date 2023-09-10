<body>
<header class="d-flex flex-column align-items-center bg-color01-02">
    <h1 class="">Gestion de Projets</h1>
    <?php if ($isConnected) {
        echo '<div class="d-flex justify-content-between"><p>' . $_SESSION['user_firstname'] .  ' • ' . $_SESSION['user_lastname'].  ' • ' . $_SESSION['user_email'] . '</p>';
        echo '<a class="btn-02" href="index.php?page=Home&method=disconnect" onclick="return confirm(\'Voulez-vous vous déconnecter ?\')">Déconnecter</a></div>';
    } ?>
    <nav class="d-flex justify-content-center" id="nav">
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
    
    <?php 
    /*
    if ($isConnected && isset($_SESSION['flash'])) {
        echo $_SESSION['flash'];
    }
    */
    ?>
</header>