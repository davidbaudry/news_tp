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
        $query->bindValue(':id', (int) $news_id, PDO::PARAM_INT);
        $query->execute();

        /*
         * On demande à PDO de transformer le résultat en objet, ici news
         * FETCH_PROPS_LATE assure qu'on fait les choses dans l'ordre : Construction (de l'objet) puis hydratation
         * (sans FETCH_PROPS_LATE l'objet serait hydraté par PDO avant même que le constructeur ne soit appelé
         */
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'News');
        $news = $query->fetch();


        $news->setDateAjout(new DateTime($news->dateAjout()));
        $news->setDateModif(new DateTime($news->dateModif()));



        return $news;
    }

    public function getCollection($limit = -1, $offset = -1)
    {
        // TODO: Implement getCollection() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }


}