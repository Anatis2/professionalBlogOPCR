<?php

namespace ClaireC\DAO;

use ClaireC\DAO\Manager;

class ArticleManager extends Manager {

    /**
     * ArticleManager constructor.
     */
    public function __construct() {
        $this->dbConnect();
    }

    /**
     * @return bool|false|PDOStatement
     */
    public function listArticles() {
        $sql = 'SELECT idArticle, titleArticle, subtitleArticle, contentArticle, DATE_FORMAT(dateCreationArticle, \'%d/%m/%Y à %Hh%imin%ss\') as dateArticle,
                       pseudoPerson
                FROM article 
                JOIN person ON article.person_idPerson = person.idPerson
                ORDER BY dateCreationArticle DESC';
        return $this->createQuery($sql);
    }

    /**
     * @return bool|false|PDOStatement
     */
    public function getArticle() {
        $sql = 'SELECT idArticle, titleArticle, subtitleArticle, contentArticle, DATE_FORMAT(dateCreationArticle, \'%d/%m/%Y à %Hh%imin%ss\') as dateCreationArticle,
                        pseudoPerson
                FROM article
                JOIN person ON article.person_idPerson = person.idPerson
                WHERE idArticle  = :idArticle';
        return $this->createQuery($sql, array('idArticle' => $_GET['idArticle']));
    }

    /**
     * @param $titleArticle
     * @param $subtitleArticle
     * @param $contentArticle
     * @param $person_idPerson
     * @return bool|false|PDOStatement
     */
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

    /**
     * @param $titleArticle
     * @param $subtitleArticle
     * @param $contentArticle
     * @return bool|false|PDOStatement
     */
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

    /**
     * @param $idArticle
     * @return bool|false|PDOStatement
     */
    public function deleteArticle($idArticle) {
        $sql = 'DELETE FROM `article` WHERE idArticle = :idArticle';
        return $this->createQuery($sql, [
            'idArticle' => $idArticle
        ]);
    }

}