<?php session_start();
$id = $_SESSION['user_login'];
$title = 'Produit'; ?>
<?php
require("C://wamp64/www/pepiniere_labranche/controller/controller.php");
try {
    $row = getUserLoggedIn($id);
} catch (PDOEXCEPTION $e) {
    $e->getMessage();
}
$username = $row['username']; ?>
<?php ob_start(); ?>
<?php
try {
    if (isset($_GET['sku']) && !empty($_GET['sku'])) {
        $sku = $_GET['sku'];
        $produit = getProduct($sku);
        if (count($produit) > 0) {
            ?>
            <div class="container scroll">
                <div class="detail-produit">
                    <h2><?php echo $produit['nom'] ?></h2>
                    <img class="" src="<?php echo $produit['image'] ?>"/></br>
                    <h3>Catégorie: <?php echo $produit['categorie'] ?></h3>
                    <p><?php echo $produit['description'] ?></p>
                    <span> Prix: <?php echo $produit['prix'] ?>$</span></br>
                    <span> Quantité: <?php echo $produit['quantite'] ?>$</span></br>
                    <a class="btn-transparent" href="panier.php?sku=<?php echo $produit['id']; ?>">Ajouter au panier</a>
                    </br>
                </div>
            </div>
            <?php
        } else {
            echo 'Rien trouvé';
        }
    }
} catch (PDOEXCEPTION $e) {
    $e->getMessage();
}
?>
<?php $page_url = "/wamp64/www/pepiniere_labranche/view/produit.php"; ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>