<?php
require_once("C://wamp64/www/pepiniere_labranche/model/Manager.php");

class SiteManager extends Manager
{
    public function getSiteInfo($page_url)
    {
        $db = $this->dbConnect();
        $query = $db->prepare("SELECT * FROM visiteurs WHERE page_url = :page_url");
        $query->execute(array('page_url' => $page_url));
        return $query;
    }

    public function getTotalViews()
    {
        $db = $this->dbConnect();
        $query = $db->prepare("SELECT sum(counter) as total_views FROM visiteurs");
        $query->execute();
        return $query;
    }

    public function insertView($page_url, $date_modif)
    {
        $db = $this->dbConnect();
        $query = $db->prepare("INSERT INTO visiteurs (page_url, counter, date_jour, derniere_modif) VALUES (:page_url, 1, NOW(), :date )ON DUPLICATE KEY UPDATE counter = counter+1");
        $query->execute(array(
            'page_url' => $page_url,
            'date' => $date_modif
        ));
        return $query;
    }
}