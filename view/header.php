<header>
    <img src="/public/images/logo.png" class="logo">
    <h1>Pépinière Labranche</h1>
    <div class="user">
        <?php
        if ($title != 'Accueil' || $title == 'Contact') {
            if (!isset($_SESSION['user_login']) && $title == 'Produits')//verifie si un utilisateur non-authorisé essaye de se logguer et aller sur la page produits
            {
                header("location: index.php");
            }

            if (isset($_SESSION['user_login'])) {

                $id = $_SESSION['user_login'];

                try {
                    $row = getUserLoggedIn($id);
                    $username = $row['username'];
                    $user = $row['id'];
                } catch (PDOEXCEPTION $e) {
                    $e->getMessage();
                }
                ?>
                <p>Bienvenue, <?php echo $username; ?></p>
                <p><a href="logout.php" class="lien-dark">Deconnexion</a></p>
                <?php
            } else {
                ?>
                <p></p>
                <?php
            }
        } else {
            ?>
            <p></p>
            <?php
        } ?>
    </div>
</header>