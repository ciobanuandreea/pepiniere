<?php
require("C://wamp64/www/pepiniere_labranche/controller/controller.php");
if (isset($_POST['submit-signup'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    if (empty($username)) {
        $errorMsg[] = "Veuillez saisir un nom d'utilisateur";    //verifie si le nom d'utilisateur a été rentré ou pas
    } else if (empty($email)) {
        $errorMsg[] = "Veuillez saisir une addresse courriel";    //verifie si le courriel a été rentré ou pas
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg[] = "Format de courriel invalide";    //verifie si le courriel a le bon format
    } else if (empty($password)) {
        $errorMsg[] = "Veuillez saisir un mot de passe";    //verifie si le mot de passe a été rentré ou pas
    } else {
        try {
            $row = getUser($username, $email);
            if ($row["username"] == $username) {
                $errorMsg[] = "Désolé cet utilisateur existe déjà. Veuillez resaisir un nom d'utilisateur.";    //affiche un message d'erreur dans le cas ou le nom d'utilisateur existe déjà dans la BD
            } else if ($row["email"] == $email) {
                $errorMsg[] = "Désolé ce courriel est déjà associé à un compte. Veuillez resaisir une addresse courriel.";    //affiche un message d'erreur dans le cas ou l'email existe déjà dans la BD
            } else if (!isset($errorMsg)) // verifie s'il n'y a pas de messages d'erreurs
            {
                $pass_hache = password_hash($password, PASSWORD_DEFAULT);
                $flag = addUser($username, $pass_hache, $email, $nom, $prenom);
                if ($flag === true) {
                    $registerMsg = "Nouvel utilisateur créé! Bienvenue sur notre site!";
                } else {
                    $errorMsg[] = "Oups... ça n'a pas fonctionné";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
<?php $title = 'Inscription'; ?>
<?php ob_start(); ?>
    <form method="POST" id="form-signup" class="form-signup" action="inscription.php">
        <fieldset>
            <legend>
                <h2>Créer compte</h2>
            </legend>
            <div class="field">
                <label for="username">Nom utilisateur</label>
                <input type="text" name="username" id="username" class="input"><br>
            </div>
            <div class="field">
                <label for="id_pw">Mot de passe</label>
                <input type="password" name="password" id="id_pw" class="input"><br>
            </div>
            <div class="field">
                <label for="confirmpassword">Confirmer mot de passe</label>
                <input type="password" name="confirmpassword" id="confirmpassword" class="input"><br>
            </div>
            <div class="field">
                <label for="id_email">Courriel</label>
                <input type="email" name="email" id="id_email" class="input"><br>
            </div>
            <div class="field">
                <label for="firstname">Prenom</label>
                <input type="text" name="prenom" id="firstname" class="input"><br>
            </div>
            <div class="field">
                <label for="lastname">Nom</label>
                <input type="text" name="nom" id="lastname" class="input"><br>
            </div>
            <input type="submit" id="submit-signup" name="submit-signup" class="btn-green" value="Créer compte">
            <input type="button" id="btn-cancel" class="btn-transparent" value="Annuler">
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
if (isset($registerMsg)) {
    ?>
    <div class="alert-success">
        <strong><?php echo $registerMsg; ?></strong>
    </div>
    <?php
}
?>
<?php $page_url = "/wamp64/www/pepiniere_labranche/view/inscription.php"; ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>