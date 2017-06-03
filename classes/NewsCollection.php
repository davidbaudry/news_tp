<?php

class NewsCollection implements SeekableIterator, Countable
{

    private $_news_collection;
    private $_position;

    public function __construct(array $news_collection)
    {
        self::hydrate($news_collection);
    }


    public function hydrate(array $news_collection)
    {
        $this->_position = 0;
        foreach ($news_collection as $news) {
            try {
                $this->_news_collection[] = self::setNewsIteration($news);
            } catch (Exception $e) {
                echo 'Exception rencontrée. Message d\'erreur : ', $e->getMessage() . '<br>';
            }
        }
    }

    /*
     * Cette méthode va contrôler les données avant hydratation
     */
    private function setNewsIteration($news)
    {
        if (!is_array($news)) {
            throw new ScorerException ('Cette entrée n\'est pas un tableau !');
        }
        // todo : d'autres contrôles ici

        return $news;
    }


    function __unset($name)
    {
        // TODO: Implement __unset() method.
    }

    /*
     * Implements methods
     */

    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    public function count()
    {
        // TODO: Implement count() method.
    }

    public function seek($position)
    {
        // TODO: Implement seek() method.
    }

    /*
     * Getters & Setters
     */




}


