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
        foreach ($news_collection as $single_news_data) {
            try {
                $this->_news_collection[] = self::setNewsIteration($single_news_data);
            } catch (Exception $e) {
                echo 'Exception rencontrée. Message d\'erreur : ', $e->getMessage() . '<br>';
            }
        }
    }

    /*
     * Cette méthode va contrôler les données avant hydratation
     */
    private function setNewsIteration($single_news_data)
    {
        if (!is_array($single_news_data)) {
            throw new ScorerException ('Cette entrée n\'est pas un tableau !');
        }
        $news = new News($single_news_data);

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
        return $this->_news_collection[$this->_position];
    }

    public function next()
    {
        $this->_position++;
    }

    public function key()
    {
        return $this->_position;
    }

    public function valid()
    {
        return isset($this->_news_collection[$this->_position]);
    }

    public function rewind()
    {
        $this->_position = 0;
    }

    public function count()
    {
        return count($this->_news_collection);
    }

    public function seek($position)
    {
        $old_position = $this->_position;
        $this->_position = $position;

        if (!$this->valid()) {
            trigger_error('La position spécifiée n\'est pas valide', E_USER_WARNING);
            $this->_position = $old_position;
        }
    }

    /*
     * Getters & Setters
     */




}


