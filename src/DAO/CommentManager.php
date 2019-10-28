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
    
     public function addComment($pseudo, $comment, $idArticle ) {
        $sql = 'INSERT INTO comment(authorComment, contentComment, article_idArticle) '
               . 'VALUES (:pseudo, :comment, :idArticle)'; 
        return $this->createQuery($sql, array('pseudo' => $pseudo, 
                                              'comment' => $comment,
                                              'idArticle' => $idArticle
                                              ));
    }


}