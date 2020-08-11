<?php
require_once("C://wamp64/www/pepiniere_labranche/model/LoginManager.php");
require_once("C://wamp64/www/pepiniere_labranche/model/ProductsManager.php");
require_once("C://wamp64/www/pepiniere_labranche/model/ProductManager.php");
require_once("C://wamp64/www/pepiniere_labranche/model/ContactManager.php");
require_once("C://wamp64/www/pepiniere_labranche/model/RegisterManager.php");
require_once("C://wamp64/www/pepiniere_labranche/model/SiteManager.php");
require_once("C://wamp64/www/pepiniere_labranche/model/CommentManager.php");

/*
 * Retourne toutes les informations de  l'utilisateur qui essaye de se connecter
 */
function login($username, $password)
{
    $loginManager = new LoginManager();
    $select_stmt = $loginManager->getLogin($username, $password);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

/*
 * Retourne le nombre de rangées que la base de donnée a trouvé en cherchant l'utilisateur qui essaye de se connecter
 */
function getRowCount($username, $password)
{
    $loginManager = new LoginManager();
    $select_stmt = $loginManager->getLogin($username, $password);
    $rowCount = $select_stmt->rowCount();
    return $rowCount;
}

/*
 * Retourne les informations de l'utilisateur connecté à l'aide de son id d'utilisateur
 */
function getUserLoggedIn($id)
{
    $loginManager = new LoginManager();
    $select_stmt = $loginManager->getUserLoggedIn($id);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

/*
 * Retourne la liste de tous les produits en paquets de trois et tous leurs informations
 */
function getProducts($limit)
{
    $productsManager = new ProductsManager();
    $stmt = $productsManager->getProducts($limit);
    $donnees = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $donnees;
}

/*
 * Retourne les informations d'un produit en particulier
 */
function getProduct($sku)
{
    $productManager = new ProductManager();
    $stmt = $productManager->getProduct($sku);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    return $produit;
}

/*
 * Ajoute un message provenant de la page contact
 */
function addMessage($name, $email, $subject, $message)
{
    $contactManager = new ContactManager();
    $affectedLines = $contactManager->addMessage($name, $email, $subject, $message);
    $flag = false;
    if ($affectedLines === $flag) {
        $flag = false;
    } else {
        $flag = true;
    }
    return $flag;
}

/*
 * Retourne toutes les informations d'un utilisateur en particulier à l'aide de son nom d'utilisateur et son courriel
 */
function getUser($username, $email)
{
    $registerManager = new RegisterManager();
    $select_stmt = $registerManager->getUser($username, $email);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

/*
 * Ajoute un utilisateur et verifie si l'opération s'est deroulé avec succès
 */
function addUser($username, $pass_hache, $email, $nom, $prenom)
{
    $registerManager = new RegisterManager();
    $affectedLines = $registerManager->addUser($username, $pass_hache, $email, $nom, $prenom);
    $flag = false;
    if ($affectedLines === $flag) {
        $flag = false;
    } else {
        $flag = true;
    }
    return $flag;
}

/*
 * Retourne tous les stats du site internet: nombre de visiteurs, date d'aujourd'hui, date de la dernière modification
 */
function getSiteInfo($page_url)
{
    $siteManager = new SiteManager();
    $query = $siteManager->getSiteInfo($page_url);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row;
}

/*
 * Retourne la somme des views de tous les pages
 */
function getTotalViews()
{
    $siteManager = new SiteManager();
    $query = $siteManager->getTotalViews();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row;
}

/*
 * Insère une view
 */
function insertView($page_url, $date_modif)
{
    $siteManager = new SiteManager();
    $affectedLines = $siteManager->insertView($page_url, $date_modif);
    $flag = false;
    if ($affectedLines === $flag) {
        $flag = false;
    } else {
        $flag = true;
    }
    return $flag;
}

/*
 * Insère une view à chaque refresh et à chaque fois que chacun des fichiers a été ouvert
 * Retourne le nombre total de views de toutes les pages
 */
function totalViews($page_url)
{
    if (file_exists($page_url)) {
        clearstatcache();
        date_default_timezone_set("America/New_York");
        $date_modif = date("Y-m-d H:i:s", filemtime($page_url));
    }
    $flag = insertView($page_url, $date_modif);
    if ($flag === true) {
        $row = getTotalViews();
        return $row['total_views'];
    }
}

/*
 * Ajoute un like/dislike
 */
function addLikeDislike($post_id, $id, $action)
{
    $commentManager = new CommentManager();
    $commentManager->addLikeDislike($post_id, $id, $action);
}

/*
 * Enlève un like/dislike
 */
function removeLikeDislike($post_id, $id)
{
    $commentManager = new CommentManager();
    $commentManager->removeLikeDislike($post_id, $id);
}

/*
 * Ajoute un commentaire de l'utilisateur connecté
 */
function postComment($comment, $author)
{
    $commentManager = new CommentManager();
    $commentManager->postComment($comment, $author);
    header("location: livredor.php");
    exit;
}

/*
 * Retourne tous les commentaires
 */
function getComments()
{
    $commentManager = new CommentManager();
    $select_stmt = $commentManager->getComments();
    $comments = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}

/*
 * Retourne le nombre total de likes ou dislikes d'un commentaire en particulier
 */
function getLikesDislikes($post_id, $action)
{
    $commentManager = new CommentManager();
    $sql = $commentManager->getLikesDislikes($post_id, $action);
    $result = $sql->fetch(PDO::FETCH_BOTH);
    return $result[0];
}

/*
 * Retourne le nombre total de likes et dislikes d'un commentaire en particulier
 */
function getRating($post_id, $action)
{
    $commentManager = new CommentManager();
    $query = $commentManager->getRating($post_id, $action);
    if ($action == 'like') {
        $likes = $query->fetch(PDO::FETCH_BOTH);
    } else if ($action == 'dislike') {
        $dislikes = $query->fetch(PDO::FETCH_BOTH);
    }
    $rating = [
        'likes' => $likes[0],
        'dislikes' => $dislikes[0]
    ];
    return json_encode($rating);
}

/*
 * Verifie si l'utilisateur a aimé(like)/pas aimé(dislike) le commentaire ou pas
 */
function userLikedDisliked($user, $post_id, $action)
{
    $commentManager = new CommentManager();
    $sql = $commentManager->userLikedDisliked($user, $post_id, $action);
    $result = $sql->fetch();
    if ($result > 0) {
        $flag = true;
    } else {
        $flag = false;
    }
    return $flag;
}

/*
 * Retourne toutes les informations d'un commentaire en particulier
 */
function getComment($commentId)
{
    $commentManager = new CommentManager();
    $select_stmt = $commentManager->getComment($commentId);
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

/*
 * Met à jour un commentaire en particulier qui a été modifié et refresh la page
 */
function updateComment($commentId, $newComment)
{
    $commentManager = new CommentManager();
    $commentManager->updateComment($commentId, $newComment);
    header("Location: livredor.php");
}