<?php session_start();
$id = $_SESSION['user_login'];
$title = 'Produits'; ?>
<?php
require("C://wamp64/www/pepiniere_labranche/controller/controller.php");
try {
    $row = getUserLoggedIn($id);
} catch (PDOEXCEPTION $e) {
    $e->getMessage();
}
$username = $row['username']; ?>
<?php ob_start(); ?>
    <div class="container scroll">
        <h2>Produits</h2>
        <?php
        try {
        $limit = "3";
        $donnees = getProducts($limit);
        ?>
        <ul class="produits first_row">
            <?php
            foreach ($donnees as $donnee) {
                ?>
                <li class="produit">
                    <h3><?php echo $donnee['nom'] ?></h3>
                    <img class="image-produit" src="<?php echo $donnee['image'] ?>"/></br>
                    <strong class="prix-produit"> Prix: <?php echo $donnee['prix'] ?>$</strong>
                    <a class="btn-transparent" href="produit.php?sku=<?php echo $donnee['id']; ?>">Voir plus</a>
                </li>
                <?php
            }
            }
            catch (Exception $e) {
                $e->getMessage();
            }
            ?>
        </ul>
        </br>
        <?php
        try {
        $limit = "3,3";
        $donnees = getProducts($limit);
        ?>
        <ul class="produits">
            <?php
            foreach ($donnees as $donnee) {
                ?>
                <li class="produit">
                    <h3><?php echo $donnee['nom'] ?></h3>
                    <img class="image-produit" src="<?php echo $donnee['image'] ?>"/> </br>
                    <span class="prix-produit"> Prix: <?php echo $donnee['prix'] ?>$</span>
                    <a class="btn-transparent" href="produit.php?sku=<?php echo $donnee['id']; ?>">Voir plus</a>
                </li>
                <?php
            }
            }
            catch (Exception $e) {
                $e->getMessage();
            }
            ?>
        </ul>
        </br>
        <?php
        try {
        $limit = "6,3";
        $donnees = getProducts($limit);
        ?>
        <ul class="produits">
            <?php
            foreach ($donnees as $donnee) {
                ?>
                <li class="produit">
                    <h3><?php echo $donnee['nom'] ?></h3>
                    <img class="image-produit" src="<?php echo $donnee['image'] ?>"/></br>
                    <span class="prix-produit"> Prix: <?php echo $donnee['prix'] ?>$</span></br></br>
                    <a class="btn-transparent" href="produit.php?sku=<?php echo $donnee['id']; ?>">Voir plus</a>
                </li>
                <?php
            }
            }
            catch (Exception $e) {
                $e->getMessage();
            }
            ?>
    </div>
<?php $page_url = "/wamp64/www/pepiniere_labranche/view/produits.php"; ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>