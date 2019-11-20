<?php

require_once("src/DAO/Manager.php");

use ClaireC\src\DAO\Manager;

class ArticleManager extends Manager {

    public function __construct() {
        $this->dbConnect();
    }

    public function listArticles() {
        $sql = 'SELECT idArticle, titleArticle, subtitleArticle, contentArticle, DATE_FORMAT(dateCreationArticle, \'%d/%m/%Y à %Hh%imin%ss\') as dateArticle,
                       pseudoPerson
                FROM article 
                JOIN person ON article.person_idPerson = person.idPerson
                ORDER BY dateCreationArticle DESC';
        return $this->createQuery($sql);
    }

    public function getArticle() {
        $sql = 'SELECT idArticle, titleArticle, subtitleArticle, contentArticle, DATE_FORMAT(dateCreationArticle, \'%d/%m/%Y à %Hh%imin%ss\') as dateCreationArticle,
                        pseudoPerson
                FROM article
                JOIN person ON article.person_idPerson = person.idPerson
                WHERE idArticle  = :idArticle';
        return $this->createQuery($sql, array('idArticle' => $_GET['idArticle']));
    }

    public function addArticle($titleArticle, $subtitleArticle, $contentArticle, $person_idPerson) {
        $sql = 'INSERT INTO article(titleArticle, subtitleArticle, contentArticle, person_idPerson)
                VALUES (:titleArticle, :subtitleArticle, :contentArticle, :person_idPerson)';
        return $this->createQuery($sql, array(
                                            'titleArticle' => $titleArticle,
                                            'subtitleArticle' => $subtitleArticle,
                                            'contentArticle' => $contentArticle,
                                            'person_idPerson' => $person_idPerson
                                    ));
    }

    public function modifyArticle($titleArticle, $subtitleArticle, $contentArticle) {
        $sql = 'UPDATE article
                SET titleArticle = :titleArticle,
                    subtitleArticle = :subtitleArticle,
                    contentArticle = :contentArticle
                WHERE idArticle = :idArticle ';
        return $this->createQuery($sql, array(
            'titleArticle' => $titleArticle,
            'subtitleArticle' => $subtitleArticle,
            'contentArticle' => $contentArticle,
            'idArticle' => $_GET['idArticle']
        ));
    }

    public function deleteArticle($idArticle) {
        $sql = 'DELETE FROM `article` WHERE idArticle = :idArticle';
        return $this->createQuery($sql, [
            'idArticle' => $idArticle
        ]);
    }

}