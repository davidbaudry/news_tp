<?php
    /*
     * Inclusions préliminaire
     */
    include '../config/boot.php';

    /*
     * Inclusion du head (portion de html commune à toutes les pages)
     */
    include 'template_head.php';

    /*
     * Début du contenu
     */

?>
<div class="container">
<h1>Bienvenue sur nos news !</h1>


<?php

echo '<h2>Les dernières News : </h2>';

$limite_news_affichees = 5;
$compteur = 0;

// parcours de la collection gràce à l'iterator
$news_collection_test = $news_manager->getCollection();
while ($compteur < $limite_news_affichees) {
    if ($news_collection_test->valid()) {
        $current_news = $news_collection_test->current();
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $current_news->getTitre(); ?></h3>
            </div>
            <div class="panel-body"><?php echo $current_news->getContenu(); ?></div>
        </div>
        <?php
        $news_collection_test->next();
        $compteur++;
    } else {
        echo 'Pas d\'autre news.';
        $compteur = $limite_news_affichees;
    }
}
?>
</div>

