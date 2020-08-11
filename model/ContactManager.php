<?php
require_once("C://wamp64/www/pepiniere_labranche/model/Manager.php");

class ContactManager extends Manager
{
    public function addMessage($name, $email, $subject, $message)
    {
        $db = $this->dbConnect();
        $insert_stmt = $db->prepare('INSERT INTO messages(nom, email, objet, message) VALUES (:name, :email, :subject, :message)');
        $insert_stmt->execute(array(
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ));
        return $insert_stmt;
    }
}