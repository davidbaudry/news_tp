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
        // TODO: Implement create() method.
    }

    protected function update(News $news)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getNewsById($news_id)
    {
        // Préparation et exécution de la requête
        $query = $this->_database_instance->prepare('
          SELECT id, auteur, titre, contenu, dateAjout, dateModif 
          FROM news 
          WHERE id = :id
        ');
        $query->bindValue('id', (int) $news_id, PDO::PARAM_INT);
        $query->execute();
        $news_data = $query->fetch(PDO::FETCH_ASSOC);
        // instanciation de l'objet news
        $my_news = new News($news_data);

        /* TODO : Débogger ce bout :
         * On demande à PDO de transformer le résultat en objet, ici news
         * FETCH_PROPS_LATE assure qu'on fait les choses dans l'ordre : Construction (de l'objet) puis hydratation
         * (sans FETCH_PROPS_LATE l'objet serait hydraté par PDO avant même que le constructeur ne soit appelé
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');
        $my_news = $query->fetch();
        */

        return $my_news;
    }

    public function getCollection($limit = -1, $offset = -1)
    {
        $query = '
          SELECT id, auteur, titre, contenu, dateAjout, dateModif 
          FROM news ORDER BY id DESC';

        // On vérifie l'intégrité des paramètres fournis.
        if ($limit != -1 || $offset != -1)
        {
            $query .= ' LIMIT '.(int) $limit.' OFFSET '.(int) $offset;
        }

        $query = $this->_database_instance->query($query);
        // les résultats sont passés à la classe collection qui s'occupera d'instancier les objets news
        $News_data = $query->fetchAll(PDO::FETCH_ASSOC);
        $news_collection = new NewsCollection($News_data);

        $query->closeCursor();

        return $news_collection;
    }


}