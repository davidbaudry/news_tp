<?php
/*
 * Page d'affichage d'une news simple
 */

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
    <h1>Votre news en détail</h1>
    <a href="home.php">Revenir à la home</a>
    <?php
    // recherche d'un id passé en paramètre
    if (isset($_GET['news_id']) && (int)$_GET['news_id'] > 0) {
        $news_id_to_seek = (int)$_GET['news_id'];
    } else {
        ?>
        <div class="alert alert-danger" role="alert">
            <strong>Oh non !</strong>
            Aucune news trouvée
        </div>
        <a href="home.php">Revenir à la home</a>
        <?php
        exit();
    }
    // construction de l'objet
    $news = $news_manager->getNewsById($news_id_to_seek);
    ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $news->getTitre(); ?></h3>
        </div>
        <div class="panel-body">
            <p><?php echo $news->getContenu($longueur_de_texte = -1); ?></p>
            <span class="small">
                    News du : <?php echo $news->getDateAjout(); ?>
                Dernière modif : <?php echo $news->getDateModif(); ?>
                Auteur : <?php echo $news->getAuteur(); ?>
                </span>
            <br>
            <a class="btn btn-xs btn-primary"
               href="administration.php?news_id=<?php echo $news->getId(); ?>">Modifier</a>
        </div>
    </div>
    <a href="home.php">Revenir à la home</a>
</div>