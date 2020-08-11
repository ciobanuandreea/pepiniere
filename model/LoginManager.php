<?php
require_once("C://wamp64/www/pepiniere_labranche/model/Manager.php");

class LoginManager extends Manager
{
    public function getLogin($username, $password)
    {
        $db = $this->dbConnect();

        $select_stmt = $db->prepare("SELECT * FROM utilisateurs WHERE username=:username OR password=:password");
        $select_stmt->execute(array(':username' => $username, ':password' => $password));
        return $select_stmt;
    }

    public function getUserLoggedIn($id)
    {
        $db = $this->dbConnect();
        $select_stmt = $db->prepare("SELECT * FROM utilisateurs WHERE id=:id");
        $select_stmt->execute(array(":id" => $id));
        return $select_stmt;
    }
}