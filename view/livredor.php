<?php session_start();
$id = $_SESSION['user_login'];
$title = 'Livre d\'or'; ?>
<?php
require("C://wamp64/www/pepiniere_labranche/controller/controller.php");
try {
    $row = getUserLoggedIn($id);
} catch (PDOEXCEPTION $e) {
    $e->getMessage();
}
$username = $row['username'];
$user = $row['id'];
if (isset($_POST['action'])) {
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];
    switch ($action) {
        case 'like':
            addLikeDislike($post_id, $id, $action);
            break;
        case 'dislike':
            addLikeDislike($post_id, $id, $action);
            break;
        case 'unlike':
            removeLikeDislike($post_id, $id);
            break;
        case 'undislike':
            removeLikeDislike($post_id, $id);
            break;
        default:
            break;
    }
    echo getRating($post_id, $action);
}
if (isset($_POST['submit-message']))
{
    $message = $_POST['message'];
    if (empty($message)) {
        $errorMsg[] = "SVP écrire un commentaire";
    } else {
        try {
            if (isset($_POST['message'])) {
                postComment($message, $username);
                $registerMsg = "Commentaire envoyé avec succès!";
            }else {
                $errorMsg[] = "Oups... ça n'a pas fonctionné";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}
$comments = getComments();
?>
<?php ob_start(); ?>
<?php

if (isset($registerMsg)) {
    ?>
    <div class="alert-success">
        <strong><?php echo $registerMsg; ?></strong>
    </div>
    <?php
}
if (isset($modifierMsg)) {
    ?>
    <div class="alert-success">
        <strong><?php echo $modifierMsg; ?></strong>
    </div>
    <?php
}
if (isset($pointsMsg)) {
    ?>
    <div class="alert-success">
        <strong><?php echo $pointsMsg; ?></strong>
    </div>
    <?php
}
?>
<form method="POST" id="form-livredor" class="form-livredor" action="livredor.php">
    <fieldset>
        <legend>
            <h2>Livre d'or</h2>
        </legend>
        <div class="field">
            <label for="message" class="message">Commentaire</label><br>
            <textarea name="message" id="message" class="input message comment-text" rows="5"></textarea><br>
        </div>
        <input type="submit" id="submit-message" name="submit-message" class="btn-green" value="Envoyer">
    </fieldset>
</form>
<div class="comments scroll">
    <?php foreach ($comments as $comment): ?>
        <div class="comment" id="comment">
            <p><strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['date_commentaire'] ?>
                <?php
                global $username;
                if ($username == $comment['auteur']) {

                    ?>
                    (<a id="btn-modifier" class="lien-light" href="modifierCommentaire.php?id=<?php echo $comment['id'];?>">Modifier</a>)
                    <?php
                }
                ?>
            </p>
            <p><?= nl2br(htmlspecialchars($comment['commentaire'])) ?></p>
            <div class="points">
                <span>Likes :</span>
                <i <?php if (userLikedDisliked($user, $comment['id'], 'like')): ?>
                    class="fas fa-thumbs-up like-btn"
                <?php else: ?>
                    class="far fa-thumbs-up like-btn"
                <?php endif ?>
                        data-id="<?php echo $comment['id'] ?>"></i>
                <span class="likes"><?php echo getLikesDislikes($comment['id'], 'like'); ?></span>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <span>Dislikes : </span>
                <i <?php if (userLikedDisliked($user, $comment['id'], 'dislike')): ?>
                    class="fas fa-thumbs-down dislike-btn"
                <?php else: ?>
                    class="far fa-thumbs-down dislike-btn"
                <?php endif ?>
                        data-id="<?php echo $comment['id'] ?>"></i>
                <span class="dislikes"><?php echo getLikesDislikes($comment['id'], 'dislike'); ?></span>
                &nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </div>
    <?php endforeach ?>
</div>
<?php $page_url = "/wamp64/www/pepiniere_labranche/view/livredor.php"; ?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
<script type="text/javascript" src="/public/js/like-dislike.js"></script>