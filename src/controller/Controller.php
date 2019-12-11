<?php

namespace ClaireC\controller;

use mysql_xdevapi\Exception;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Controller {

    public function __construct() {
        // Initilisation to use Twig
        $loader = new Twig_Loader_Filesystem('templates');
        $this->twig = new Twig_Environment($loader, [
            'cache' => false, // __DIR__ . '/tmp'
        ]);
    }

    /**
     * Verify if the user is connected
     * @return bool
     */
    public function verifyConnection() {
        $isConnected = empty($_SESSION) ? false : true;
        return $isConnected;
    }

    /**
     * Verify is the user have administrator rights
     * @return bool
     */
    public function isAdmin() {
        $isConnected = self::verifyConnection();
        if($isConnected) {
            $typePerson = $_SESSION['typePerson'];
            if($typePerson=='Admin') {
                $isAdmin = true;
            } else {
                $isAdmin = false;
            }
            return $isAdmin;
        }
    }

    /**
     * Format and filter $_POST superglobal variables
     * @param $postName
     * @return string
     */
    public function defaultPostControl($postName) {
        return htmlspecialchars(trim(filter_input(INPUT_POST, $postName)));
    }

    /**
     * Format and filter $_GET superglobal variables
     * @param $postName
     * @return string
     */
    public function defaultGetControl($postName) {
        return htmlspecialchars(trim(filter_input(INPUT_GET, $postName)));
    }

}