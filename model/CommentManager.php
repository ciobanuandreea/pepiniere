<?php
require_once("C://wamp64/www/pepiniere_labranche/model/Manager.php");

class CommentManager extends Manager
{

    public function addLikeDislike($post_id, $id, $action)
    {
        $db = $this->dbConnect();
        $stmt_insert = $db->prepare("INSERT INTO rating_info (comment_id, user_id, rating_action) VALUES (:post_id, :user_id, :action)");
        $stmt_insert->execute(array(
            'post_id' => $post_id,
            'user_id' => $id,
            'action' => $action));
        return $stmt_insert;
    }

    public function removeLikeDislike($post_id, $id)
    {
        $db = $this->dbConnect();
        $stmt_delete = $db->prepare("DELETE FROM rating_info WHERE comment_id = :post_id AND user_id =:user_id");
        $stmt_delete->execute(array(
            'post_id' => $post_id,
            'user_id' => $id));
        return $stmt_delete;
    }

    public function postComment($comment, $author)
    {
        $db = $this->dbConnect();

        $sql = $db->prepare('INSERT INTO commentaires(commentaire, auteur, date_commentaire) VALUES(:comment, :author, NOW())');
        $sql->execute(array(
            'comment' => $comment,
            'author' => $author));
        return $sql;
    }

    public function getComments()
    {
        $db = $this->dbConnect();

        $select_stmt = $db->prepare("SELECT * FROM commentaires ORDER BY id ASC LIMIT 10");
        $select_stmt->execute();
        return $select_stmt;
    }

    public function getLikesDislikes($post_id, $action)
    {
        $db = $this->dbConnect();
        $sql = $db->prepare("SELECT COUNT(*) FROM rating_info WHERE comment_id = :post_id AND rating_action= :action");
        $sql->execute(array(
            'post_id' => $post_id,
            'action' => $action
        ));
        return $sql;
    }

    public function getRating($post_id, $action)
    {

        $db = $this->dbConnect();
        $query = $db->prepare("SELECT COUNT(*) FROM rating_info WHERE comment_id = :post_id AND rating_action= :action");
        $query->execute(array(
            'post_id' => $post_id,
            'action' => $action
        ));
        return $query;
    }

    public function userLikedDisliked($user, $post_id, $action)
    {
        $db = $this->dbConnect();
        $sql = $db->prepare("SELECT * FROM rating_info WHERE user_id=:user AND comment_id=:post_id AND rating_action=:action");
        $sql->execute(array(
            'user' => $user,
            'post_id' => $post_id,
            'action' => $action
        ));
        return $sql;
    }

    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $select_stmt = $db->prepare("SELECT id, commentaire, auteur, DATE_FORMAT(date_commentaire, '%d/%m/%Y à %Hh%imin%ss') FROM commentaires WHERE id = ?");
        $select_stmt->execute(array($commentId));
        return $select_stmt;
    }

    public function updateComment($commentId, $newComment)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('UPDATE commentaires SET commentaire=:comment, date_commentaire = NOW() WHERE id=:id');
        $req->execute(array('comment' => $newComment, 'id' => $commentId));
        return $req;
    }

}