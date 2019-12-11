<?php

namespace ClaireC\DAO;

use \PDO;

abstract class Manager {

    /**
     * @return PDO
     */
    protected function dbConnect() {
        try {
            $db = new PDO('mysql:host=localhost;dbname=opcr_projet5_professionalBlog;charset=utf8', LOGINBDD, PWDBDD,
                            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $db;
        } catch (Exception $ex) {
            echo "ERREUR : échec de la connection à la BDD" . $ex->getMessage();
        }
    }

    /**
     * @param $sql
     * @param null $parameters
     * @return bool|false|\PDOStatement
     */
    protected function createQuery($sql, $parameters=null) {
        if($parameters) {
            $result = $this->dbConnect()->prepare($sql);
            $result->execute($parameters);
            return $result;
        }
        $result = $this->dbConnect()->query($sql);
        return $result;
    }

}
