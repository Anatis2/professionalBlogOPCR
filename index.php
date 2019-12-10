<?php

// inclusion of Twig's and others autoloaders
require 'vendor/autoload.php';

// initialisation to use Twig
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false, // __DIR__ . '/tmp'
]);


// inclusion of our Controllers
require 'src/controller/ArticleController.php';
require 'src/controller/CommentController.php';
require 'src/controller/MemberController.php';

// inclusion of our Classes
use ClaireC\src\model\Article;
use ClaireC\src\model\Comment;
use ClaireC\src\model\Member;

require_once 'conf/config.php';

session_start();
$pseudoPerson = "";

// instanciation of our classes
$articleController = new ArticleController();
$commentController = new CommentController();
$memberController = new MemberController();

// Routing
$page = "home";

if(isset($_GET['page'])) {
    $page = filter_input(INPUT_GET, 'page');
}

if(isset($_GET['numPage'])) {
    $numPage = filter_input(INPUT_GET,'numPage');
}

switch ($page) {
    // Visitors && Members
    case 'home':
        $articleController->getPageHome();
        break;
    case 'contact':
        $articleController->getPageContact();
        break;
    case 'blog':
        $articleController->pagesManager();
        break;
    case 'article':
        $articleController->getArticle();
        break;
    case 'inscription':
        $memberController->createMember();
        break;
    case 'connexion':
        $memberController->connectMember();
        break;
    // Admin
    case 'adminHome':
        $memberController->getPageAdminHome();
        break;
    case 'seeMyProfile':
        $memberController->getMemberProfile();
        break;
    case 'addArticle':
        $articleController->getPageAdminAddArticle();
        break;
    case 'manageArticles':
        $articleController->pagesManager();
        break;
    case 'manageArticle':
        $articleController->getArticle();
        break;
    case 'modifyArticle':
        $articleController->modifyArticle();
        break;
    case 'deleteArticle':
        $articleController->deleteArticle();
        var_dump($_POST);
        break;
    case 'manageComments':
        $commentController->getPageManageComments();
        break;
    case 'listMembers':
        $memberController->listMembers();
        break;
    case 'deconnexion':
        header('Location: index.php?page=home');
        session_destroy();
        break;
    default :
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');                        
}


