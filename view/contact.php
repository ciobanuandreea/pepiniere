<?php
session_start();
require("C://wamp64/www/pepiniere_labranche/controller/controller.php");
if (isset($_POST['submit-contact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($name)) {
        $errorMsg[] = "Veuillez saisir un nom";
    } else if (empty($email)) {
        $errorMsg[] = "Veuillez saisir un courriel";
    } else if (empty($subject)) {
        $errorMsg[] = "Veuillez saisir un sujet";
    } else if (empty($message)) {
        $errorMsg[] = "Veuillez saisir un message";
    } else {
        try {
            $flag = addMessage($name, $email, $subject, $message);
            if ($flag === true) {
                $registerMsg = "Message envoyé avec succès!";
            } else {
                $errorMsg[] = "Oups... ça n'a pas fonctionné";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
<?php $title = 'Contact'; ?>
<?php ob_start(); ?>
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
<div class="contact">
    <div class="adresse emplacement">
        <h2>Adresse</h2>
        <p>6400 16e Avenue,</br>Montréal,</br>QC H1X 2S9</br></p>
        <p>Téléphone: (514) 376-1620</p>
    </div>
    <form method="POST" id="form-contact" class="form-contact" action="">
        <fieldset>
            <legend>
                <h2>Contact</h2>
            </legend>
            <div class="field">
                <label for="name">Nom</label>
                <input type="text" name="name" id="name" class="input"><br>
            </div>
            <div class="field">
                <label for="contact_email">Courriel</label>
                <input type="email" name="email" id="contact_email" class="input"><br>
            </div>
            <div class="field">
                <label for="subject">Objet</label>
                <input type="text" name="subject" id="subject" class="input"><br>
            </div>
            <div class="field">
                <label for="message" class="message">Message</label>
                <textarea name="message" id="message" class="input message" rows="5"></textarea><br>
            </div>
            <input type="submit" id="submit-contact" name="submit-contact" class="btn-green" value="Envoyer">
        </fieldset>
    </form>
    <div class="adresse carte">
        <h2>Carte</h2>
        <div id="map"></div>
    </div>
</div>
<?php $page_url = "/wamp64/www/pepiniere_labranche/view/contact.php"; ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
<script type="text/javascript" src="/public/js/map.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCo0onn2NLXlFRHkWepXkC9Dc2jNAormqg&callback=initMap">
</script>