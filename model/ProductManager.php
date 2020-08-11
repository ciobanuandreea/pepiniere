<?php
require_once("C://wamp64/www/pepiniere_labranche/model/Manager.php");

class ProductManager extends Manager
{
    public function getProduct($sku)
    {
        $db = $this->dbConnect();
        $stmt = $db->prepare("SELECT * FROM produits WHERE id=:id");
        $stmt->execute(array('id' => $sku));
        return $stmt;
    }
}