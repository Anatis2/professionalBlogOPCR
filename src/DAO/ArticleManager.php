<?php

require_once("src/DAO/Manager.php");

use ClaireC\src\DAO\Manager;



class ArticleManager extends Manager {

    public function __construct() {
        $this->dbConnect();
    }

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

    /*public function addArticle($titleArticle, $subtitleArticle, $contentArticle, $idPerson) {
        $sql = 'INSERT INTO article(titleArticle, subtitleArticle, contentArticle, person_idPerson)
                VALUES (?, ?, ?, ?)';
        return $this->createQuery($sql, array($titleArticle, $subtitleArticle, $contentArticle, 1));
    }*/

}