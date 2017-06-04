<?php

class NewsManagerPDO extends NewsManager
{

    private $_database_instance;

    public function __construct(PDO $database_instance)
    {
        $this->_database_instance = $database_instance;
    }

    protected function create(News $news)
    {
        $query = $this->_database_instance->prepare('
            INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif) 
            VALUES(:auteur, :titre, :contenu, NOW(), NOW())');
        $query->bindValue(':titre', $news->getTitre());
        $query->bindValue(':auteur', $news->getAuteur());
        $query->bindValue(':contenu', $news->getContenu());
        if ($query->execute()) {
            // on renvoit le dernier id en database
            return $this->_database_instance->lastInsertId();
        }
        return false;
    }

    protected function update(News $news)
    {
        $query = $this->_database_instance->prepare('
            UPDATE news 
            SET auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW() 
            WHERE id = :id');
        $query->bindValue(':titre', $news->getTitre());
        $query->bindValue(':auteur', $news->getAuteur());
        $query->bindValue(':contenu', $news->getContenu());
        $query->bindValue(':id', $news->getId(), PDO::PARAM_INT);
        if ($query->execute()) {
            return true;
        }
        return false;
    }

    public function delete($news_id)
    {
        return ($this->_database_instance->exec('DELETE FROM news WHERE id = ' . (int)$news_id));
    }

    public function getNewsById($news_id)
    {
        // Préparation et exécution de la requête
        $query = $this->_database_instance->prepare('
          SELECT id, auteur, titre, contenu, dateAjout, dateModif 
          FROM news 
          WHERE id = :id
        ');
        $query->bindValue('id', (int)$news_id, PDO::PARAM_INT);
        $query->execute();
        $news_data = $query->fetch(PDO::FETCH_ASSOC);
        // instanciation de l'objet news
        $my_news = new News($news_data);

        if ($my_news->isValid()) {
            return $my_news;
        }
        return false;
    }

    /*
     * Persist a news
     */
    public function persist(News $news)
    {
        if ($news->isValid()) {
            if ($news->isNew()) {
                // la methode create renverra l'id de la dernière entrée en database
                $news_id = $this->create($news);
            } else {
                $this->update($news);
                // en cas d'update l'id ne change pas
                $news_id = $news->getId();
            }
            return $this->getNewsById($news_id);
        }
        return false;
    }

    public function getCollection($limit = -1, $offset = -1)
    {
        $query = '
          SELECT id, auteur, titre, contenu, dateAjout, dateModif 
          FROM news ORDER BY dateAjout DESC';

        // On vérifie l'intégrité des paramètres fournis.
        if ($limit != -1 || $offset != -1) {
            $query .= ' LIMIT ' . (int)$limit . ' OFFSET ' . (int)$offset;
        }

        $query = $this->_database_instance->query($query);
        // les résultats sont passés à la classe collection qui s'occupera d'instancier les objets news
        $News_data = $query->fetchAll(PDO::FETCH_ASSOC);
        $news_collection = new NewsCollection($News_data);

        $query->closeCursor();

        return $news_collection;
    }

}