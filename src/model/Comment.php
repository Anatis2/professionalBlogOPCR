<?php

namespace ClaireC\src\model;

class Comment {

    protected $idComment;
    protected $authorComment;
    protected $contentComment;
    protected $dateComment;

    //GETTERS
    public function getIdComment(){return $this->idComment;}
    public function getAuthorComment(){return $this->authorComment;}
    public function getContentComment(){return $this->contentComment;}
    public function getDateComment(){return $this->dateComment;}

    //SETTERS
    public function setIdComment($idComment) {
        $this->idComment = $idComment;
    }

    public function setAuthorComment($authorComment) {
        $this->authorComment = $authorComment;
    }

    public function setContentComment($contentComment) {
        $this->contentComment = $contentComment;
    }

    public function setDateComment($dateComment) {
        $this->dateComment = $dateComment;
    }




}