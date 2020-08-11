<?php
require_once("C://wamp64/www/pepiniere_labranche/model/Manager.php");

class RegisterManager extends Manager
{

    public function getUser($username, $email)
    {
        $db = $this->dbConnect();
        $select_stmt = $db->prepare("SELECT username, email, password FROM utilisateurs WHERE username=:username OR email=:email");
        $select_stmt->execute(array(':username' => $username, ':email' => $email));
        return $select_stmt;
    }

    public function addUser($username, $pass_hache, $email, $nom, $prenom)
    {
        $db = $this->dbConnect();
        $insert_stmt = $db->prepare('INSERT INTO utilisateurs(username, password, email, nom, prenom) VALUES (:username, :password, :email, :nom, :prenom)');
        $insert_stmt->execute(array(
            'username' => $username,
            'password' => $pass_hache,
            'email' => $email,
            'nom' => $nom,
            'prenom' => $prenom
        ));
        return $insert_stmt;
    }
}