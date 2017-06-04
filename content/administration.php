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


// Vérification des envois du formulaire
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'Modifier') {
        // update
        $news = new News(
            [
                'id' => htmlspecialchars($_POST['news_id']),
                'auteur' => htmlspecialchars($_POST['auteur']),
                'titre' => htmlspecialchars($_POST['titre']),
                'contenu' => htmlspecialchars($_POST['contenu'])
            ]
        );
        $news = $news_manager->persist($news);

    } else {
        if ($_POST['action'] == 'Ajouter') {
            // create
            $news = new News(
                [
                    'auteur' => htmlspecialchars($_POST['auteur']),
                    'titre' => htmlspecialchars($_POST['titre']),
                    'contenu' => htmlspecialchars($_POST['contenu'])
                ]
            );
            $news = $news_manager->persist($news);
        } else {
            if ($_POST['action'] == 'Supprimer') {
                // delete
                $news_id_to_delete = (int)htmlspecialchars($_POST['news_id']);
                if ($news_id_to_delete > 0) {
                    if ($news_manager->delete($news_id_to_delete)) {
                        echo '
                            <div class="alert alert-warning" role="alert">
                            <strong>News détruite !</strong>
                            Et c\'est irrémédiable
                            </div>';
                    }
                }
            }
        }
    }
}

// sinon vérification du passage par get (demande de modif de la news)
if (isset($_GET['news_id']) && ((int)$_GET['news_id'] > 0)) {
    echo 'mod from url';
    $mode = 'update';
    // construction de l'objet
    $news = $news_manager->getNewsById((int)$_GET['news_id']);
}

?>
<div class="container">
    <h1>Administration des news</h1>

    <a href="home.php">Revenir à la home</a>
    <?php
    // si il y a une news de chargée, on propose de passer en mode ajout :
    if (isset($news)) {
        echo ' | <a href="administration.php">Créer une nouvelle news</a>';
    }
    ?>

    <form action="administration.php" method="post">

        <label for="auteur">Auteur : </label>
        <br/>
        <input type="text" name="auteur" placeholder="Nom de l'auteur"
               value="<?php if (isset($news)) {
                   echo $news->getAuteur();
               } ?>"/>
        <br/>

        <label for="titre">Titre : </label>
        <br/>
        <input type="text" name="titre" placeholder="Un titre explicite"
               value="<?php if (isset($news)) {
                   echo $news->getTitre();
               } ?>"/>
        <br/>

        <label for="contenu">Contenu :</label>
        <br/>
        <textarea rows="5" cols="42" name="contenu"><?php if (isset($news)) {
                echo $news->getContenu();
            } ?></textarea>
        <br/>
        <br/>

        <?php
        if (isset($news)) {
            ?>
            <input type="hidden" name="news_id" value="<?php echo $news->getId() ?>"/>
            <input class="btn btn-lg btn-primary" type="submit" value="Modifier" name="action"/>
            <input class="btn btn-lg btn-danger" type="submit" value="Supprimer" name="action"/>
            <?php
        } else {
            ?>
            <input class="btn btn-lg btn-primary" type="submit" value="Ajouter" name="action"/>
            <?php
        }
        ?>
    </form>
    <br/>
    <hr/>
    <br/>
    <?php
    $news_collection = $news_manager->getCollection();

    ?>
    Il y a actuellement <?php echo $news_collection->count() ?> news. En voici la liste :
    <table class="table table-striped">
        <tr>
            <th>Auteur</th>
            <th>Titre</th>
            <th>Date d'ajout</th>
            <th>Dernière modification</th>
            <th>Action</th>
        </tr>
        <?php
        while ($news_collection->valid()) {

            $current_news = $news_collection->current();
            echo '
                <tr>
                    <td>' . $current_news->getAuteur() . '</td>
                    <td>' . $current_news->getTitre() . '</td>
                    <td>' . $current_news->getDateAjout() . '</td>
                    <td>' . $current_news->getDateModif() . '</td>
                    <td><a href="?news_id=', $current_news->getId(), '">Modifier</a>
                    </td>
                 </tr>
                 <br />';
            $news_collection->next();
        }
        ?>
    </table>
</div>
</body>
</html>