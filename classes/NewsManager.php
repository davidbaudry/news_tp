<?php

abstract class NewsManager
{


    /*
     * CRUD Methods
     */

    abstract protected function create(News $news);

    abstract protected function update(News $news);

    abstract protected function delete($id);

    abstract protected function persist(News $news);

    abstract protected function getNewsById($id);

    abstract protected function getCollection($limit = -1, $offset = -1);




}