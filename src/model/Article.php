<?php

namespace ClaireC\src\model;

class Article {

    protected $idArticle;
    protected $titleArticle;
    protected $subtitleArticle;
    protected $contentArticle;
    protected $dateCreationArticle;

    /*public function __construct(array $donnees) {
        $this->hydrate($donnees);
    }

    // HYDRATATION
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);
        }
        if(method_exists($this, $method)) {
            $this->$method($value);
        }
    }*/

    // GETTERS
    public function getIdArticle() { return $this->idArticle; }
    public function getTitleArticle() { return $this->titleArticle; }
    public function getSubtitleArticle() { return $this->subtitleArticle; }
    public function getContentArticle() { return $this->contentArticle; }
    public function getDateCreationArticle() { return $this->dateCreationArticle; }

    // SETTERS
    public function setIdArticle($idArticle) {
        $this->idArticle = $idArticle;
    }

    public function setTitleArticle($titleArticle) {
        $this->titleArticle = $titleArticle;
    }

    public function setSubtitleArticle($subtitleArticle) {
        $this->subtitleArticle = $subtitleArticle;
    }

    public function setContentArticle($contentArticle) {
        $this->contentArticle = $contentArticle;
    }

    public function setDateCreationArticle($dateCreationArticle) {
        $this->dateCreationArticle = $dateCreationArticle;
    }



}