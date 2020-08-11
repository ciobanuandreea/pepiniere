<?php
require("C://wamp64/www/pepiniere_labranche/controller/controller.php");
session_start();
if (isset($_SESSION["user_login"])) {
    header("location: produits.php");
}
if (isset($_POST['submit-login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (empty($username)) {
        $errorMsg[] = "Veuillez rentrer un nom d'utilisateur";
    } else if (empty($password)) {
        $errorMsg[] = "Veuillez rentrer un mot de passe";
    } else {
        try {
            $row = login($username, $password);
            $row_count = getRowCount($username, $password);
            if ($row_count > 0) {
                if ($username == $row["username"] or $password == $row["password"]) {
                    if (password_verify($password, $row["password"])) {
                        $_SESSION["user_login"] = $row["id"];
                        $loginMsg = "Connexion réussie";
                        header("refresh:2; produits.php");
                    } else {
                        $errorMsg[] = "Mauvais mot de passe";
                    }
                } else {
                    $errorMsg[] = "Mauvais nom d'utilisateur";
                }
            } else {
                $errorMsg[] = "Mauvais nom d'utilisateur";
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
}
?>
<?php $title = 'Accueil'; ?>
<?php ob_start(); ?>
    <form role="form" method="post" action="index.php" id="form-login">
        <fieldset>
            <legend>
                <h2>Se connecter</h2>
            </legend>
            <div class="field">
                <label for="nom_utilisateur">Nom utilisateur</label>
                <input type="text" name="username" id="nom_utilisateur" class="input"><br>
            </div>
            <div class="field">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" class="input"><br>
            </div>
            <input type="submit" id="submit-login" name="submit-login" class="btn-green" value="Se connecter">
            <input type="button" id="btn-signup" class="btn-transparent" value="Créer un compte">
        </fieldset>
    </form>
<?php
if (isset($errorMsg)) {
    foreach ($errorMsg as $error) {
        ?>
        <div class="alert-error">
            <strong><?php echo $error; ?></strong>
        </div>
        <?php
    }
}
if (isset($loginMsg)) {
    ?>
    <div class="alert-success">
        <strong><?php echo $loginMsg; ?></strong>
    </div>
    <?php
}
?>
<?php $page_url = "/wamp64/www/pepiniere_labranche/view/index.php"; ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>