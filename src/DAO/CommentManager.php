<?php

require_once("src/DAO/Manager.php");

use ClaireC\src\DAO\Manager;

class CommentManager extends Manager {

    public function listComments() {
        $sql = 'SELECT *
                FROM comment 
                WHERE article_idArticle  = :idArticle
                ORDER BY dateComment DESC';

        return $this->createQuery($sql, array('idArticle' => $_GET['idArticle']));
    }


}