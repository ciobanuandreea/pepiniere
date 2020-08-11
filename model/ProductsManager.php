<?php
require_once("C://wamp64/www/pepiniere_labranche/model/Manager.php");

class ProductsManager extends Manager
{
    public function getProducts($limit)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare("SELECT * FROM produits ORDER BY nom LIMIT $limit");
        $stmt->execute();
        return $stmt;
    }
}