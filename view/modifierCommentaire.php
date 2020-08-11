<?php session_start();
$id = $_SESSION['user_login'];
$title = 'Modifier commentaire'; ?>
<?php
require("C://wamp64/www/pepiniere_labranche/controller/controller.php");
try {
    $row = getUserLoggedIn($id);
} catch (PDOEXCEPTION $e) {
    $e->getMessage();
}
$username = $row['username'];
?>
<?php
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $commentId = $_GET['id'];
}
$comment = getComment($commentId);
if (isset($_POST['submit-modifier'])) {
    $newComment = $_POST['modifier'];
    updateComment($commentId, $newComment);
}
?>
<?php
if ($username == $comment['auteur']) {
    ?>
    <form method="post" id="form-modifier" class="form-modifier"
          action="">
        <fieldset>
            <div class="field">
                <p>Commentaire de <strong><?= htmlspecialchars($comment['auteur']) ?></strong> : </p><br>
                <textarea name="modifier" id="modifier" class="input message comment-text"
                          rows="5"><?php echo $comment['commentaire']; ?></textarea><br>
            </div>
            <input type="submit" id="submit-modifier" name="submit-modifier" class="btn-green"
                   value="Modifier">
        </fieldset>
    </form>
    <?php
}
?>
    </div>
<?php $page_url = "/wamp64/www/pepiniere_labranche/view/modifierCommentaire.php"; ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>