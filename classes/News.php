<?php

class News
{
    private
        $_id,
        $_auteur,
        $_titre,
        $_contenu,
        $_dateAjout,
        $_dateModif;

    /**
     * News constructor.
     */
    public function __construct(array $news_data)
    {
        $this->hydrate($news_data);
    }

    /*
     * La fonction d'hydratation va utiliser les setters (contrôle) avec les
     * données venant de la DBB (ou autre)
     */
    public function hydrate(array $news_data)
    {
        foreach ($news_data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }



    /*
     * GETTERS AND SETTERS
     */

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->_auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->_auteur = $auteur;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->_titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->_titre = utf8_encode($titre);
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->_contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->_contenu = $contenu;
    }

    public function setDateAjout($dateAjout)
    {
        $this->_dateAjout = $dateAjout;
    }



    /**
     * @return mixed
     */
    public function getDateModif()
    {
        return $this->_dateModif;
    }

    public function setDateModif($dateModif)
    {
        $this->_dateModif = $dateModif;
    }



}