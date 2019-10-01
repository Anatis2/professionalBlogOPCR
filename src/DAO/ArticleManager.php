<?php

require_once("src/DAO/Manager.php");


class ArticleManager extends Manager {

    public function listArticles() {
        $sql = 'SELECT idArticle, titleArticle, subtitleArticle, contentArticle, DATE_FORMAT(dateCreationArticle, \'%d/%m/%Y à %Hh%imin%ss\') as dateCreationArticle
                FROM article 
                ORDER BY dateCreationArticle DESC';
        return $this->createQuery($sql);
    }

    public function getArticle() {
        $sql = 'SELECT idArticle, titleArticle, subtitleArticle, contentArticle, DATE_FORMAT(dateCreationArticle, \'%d/%m/%Y à %Hh%imin%ss\') as dateCreationArticle
                FROM article
                WHERE idArticle  = :idArticle';
        return $this->createQuery($sql, array('idArticle' => $_GET['idArticle']));
    }

    public function countArticles() {
        $sql = 'SELECT COUNT(*) as countArticles
                FROM article';
        return $this->createQuery($sql);
    }

}