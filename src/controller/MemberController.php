<?php

require_once('src/DAO/MemberManager.php');

class MemberController {

    public function __construct() {
        // Initilisation to use Twig
        $loader = new Twig_Loader_Filesystem('templates');
        $this->twig = new Twig_Environment($loader, [
            'cache' => false, // __DIR__ . '/tmp'
        ]);
    }

    public function createMember($surname, $firstname, $passwordHash) {
        $memberManager = new MemberManager();
        return $memberManager->createMember($surname, $firstname, $passwordHash);
    }

}