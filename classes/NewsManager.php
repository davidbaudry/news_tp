<?php

abstract class NewsManager
{


    /*
     * CRUD Methods
     */

    abstract protected function create(News $news);

    abstract protected function update(News $news);

    abstract public function delete($id);

    /*
     * Persist a news
     */
    public function persist(News $news)
    {
        if ($news->isValid()) {
            $news->isNew() ? $this->add($news) : $this->update($news);
        } else {
            throw new RuntimeException('Invalid news');
        }
    }

    abstract public function getNewsById($id);

    abstract public function getCollection($limit = -1, $offset = -1);




}