<?php


namespace ClaireC\controller;


use Twig_Environment;
use Twig_Loader_Filesystem;

class controller {

    public function __construct() {
        // Initilisation to use Twig
        $loader = new Twig_Loader_Filesystem('templates');
        $this->twig = new Twig_Environment($loader, [
            'cache' => false, // __DIR__ . '/tmp'
        ]);
    }

    public function verifyConnection() {
        $isConnected = empty($_SESSION) ? false : true;
        return $isConnected;
    }

    public function getSessionInformations() {

    }



}