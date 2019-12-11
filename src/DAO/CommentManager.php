<?php

namespace ClaireC\DAO;

use ClaireC\DAO\Manager;

class CommentManager extends Manager {

    /**
     * @return bool|false|PDOStatement
     */
    public function listCommentsById() {
        $sql = "SELECT *
                FROM comment 
                WHERE article_idArticle  = :idArticle
                AND comment.validate = 'Validé'
                ORDER BY dateComment DESC";
        return $this->createQuery($sql, array('idArticle' => $_GET['idArticle']));
    }

    /**
     * @param $pseudo
     * @param $comment
     * @param $idArticle
     * @return bool|false|PDOStatement
     */
     public function addComment($pseudo, $comment, $idArticle ) {
        $sql = 'INSERT INTO comment(authorComment, contentComment, article_idArticle) '
               . 'VALUES (:pseudo, :comment, :idArticle)'; 
        return $this->createQuery($sql, array('pseudo' => $pseudo, 
                                              'comment' => $comment,
                                              'idArticle' => $idArticle
                                              ));
    }

    /**
     * @return bool|false|PDOStatement
     */
    public function listCommentsToValidate() {
        $sql = "SELECT titleArticle, idComment, contentComment, dateComment, authorComment, validate
                    FROM comment
                    JOIN article ON article_idArticle = idArticle
                    WHERE validate = 'En attente'";
        return $this->createQuery($sql);
    }

    /**
     * @param $idComment
     * @return bool|false|PDOStatement
     */
    public function validateComment($idComment) {
        $sql = "UPDATE comment SET validate='Validé' WHERE idComment = :idComment";
        return $this->createQuery($sql, array('idComment' => $idComment));
    }

    public function refuseComment($idComment) {
        $sql = "UPDATE comment SET validate='Refusé' WHERE idComment = :idComment";
        return $this->createQuery($sql, array('idComment' => $idComment));
    }

    /**
     * @return bool|false|PDOStatement
     */
    public function getAuthorsComments(){
        $sql = "SELECT DISTINCT authorComment
                    FROM comment";
        return $this->createQuery($sql);
    }

    /**
     * @param $statute
     * @return bool|false|PDOStatement
     */
    public function filterCommentsByStatute($statute) {
        $sql = "SELECT titleArticle, idComment, contentComment, dateComment, authorComment, validate
                    FROM comment
                    JOIN article ON article_idArticle = idArticle
                    WHERE validate = :statute";
        return $this->createQuery($sql, array('statute' => $statute));
    }

    /**
     * @param $author
     * @return bool|false|PDOStatement
     */
    public function filterCommentsByAuthor($author) {
        $sql = "SELECT titleArticle, idComment, contentComment, dateComment, authorComment, validate
                    FROM comment
                    JOIN article ON article_idArticle = idArticle
                    WHERE authorComment = :authorComment";
        return $this->createQuery($sql, array('authorComment' => $author));
    }

    /**
     * @return bool|false|PDOStatement
     */
    public function listComments() {
        $sql = "SELECT titleArticle, idComment, contentComment, dateComment, authorComment, validate
                    FROM comment
                    JOIN article ON article_idArticle = idArticle";
        return $this->createQuery($sql);
    }


}