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
    <a href="administration.php">Aller à l'administration</a>

    <?php

    echo '<h2>Les dernières News : </h2>';

    $limite_news_affichees = 5;
    $compteur = 0;

    // parcours de la collection gràce à l'iterator
    $news_collection = $news_manager->getCollection();
    while ($compteur < $limite_news_affichees) {
        if ($news_collection->valid()) {
            $current_news = $news_collection->current();
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="<?php echo LINK_BASE_URL; ?>content/single_news.php?news_id=<?php echo $current_news->getId(); ?>">
                            <?php echo $current_news->getTitre(); ?>
                        </a>
                    </h3>
                </div>
                <div class="panel-body">
                    <p><?php echo $current_news->getContenu($longueur_de_texte = 200); ?></p>
                <span class="small">
                    News du : <?php echo $current_news->getDateAjout(); ?>
                    Dernière modif : <?php echo $current_news->getDateModif(); ?>
                    Auteur : <?php echo $current_news->getAuteur(); ?>
                </span>
                </div>
            </div>
            <?php
            $news_collection->next();
            $compteur++;
        } else {
            echo 'Pas d\'autre news.';
            $compteur = $limite_news_affichees;
        }
    }
    ?>
</div>

