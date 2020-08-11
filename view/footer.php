<?php
$row = getSiteInfo($page_url);
$date_jour = $row['date_jour'];
$derniere_modif = $row['derniere_modif'];
?>
<footer class="footer">
    <div class="footer-sections">
        <div class="footer-section"><span>Visiteurs: </span><span><?php $total_website_views = totalViews($page_url);
                echo $total_website_views; ?></span></div>
        <div class="footer-section"><span>Date: </span><span><?php echo $date_jour; ?></span>
            <p>&copy; tous droits réservés</p>
            <a href="https://icons8.com/icon/81283/apple-tree">Apple Tree icon by Icons8</a>
        </div>
        <div class="footer-section"><span>Dernière modification: </span><span><?php echo $derniere_modif; ?></span>
        </div>
    </div>
</footer>