<?php
if (!isset($_SESSION['user_login'])) {
    ?>
    <nav class="menu" id="menu">
        <ul class="nav">
            <li><a href="http://pepiniere/view/index.php">Accueil</a></li>
            <li><a href="http://pepiniere/view/contact.php">Contact</a></li>
            <li><a id="theme-button">Changer le thème</a>
                <ul id="theme-menu">
                    <li class="theme-color" id="theme-dark">Dark</li>
                    <li class="theme-color" id="theme-light">Light</li>
                </ul>
            </li>
        </ul>
    </nav>
    <?php
} else {
    ?>
    <nav class="menu" id="menu">
        <ul class="nav">
            <li><a href="http://pepiniere/view/produits.php">Produits</a></li>
            <li><a href="http://pepiniere/view/livredor.php">Livre d'or</a></li>
            <li><a href="http://pepiniere/view/contact.php">Contact</a></li>
            <li><a id="theme-button">Changer le thème</a>
                <ul id="theme-menu">
                    <li class="theme-color" id="theme-dark">Dark</li>
                    <li class="theme-color" id="theme-light">Light</li>
                </ul>
            </li>
        </ul>
    </nav>
    <?php
} ?>