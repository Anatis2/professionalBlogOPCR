<?php

// inclusion of Twig's autoloader
require 'vendor/autoload.php';

// initialisation to use Twig
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false, // __DIR__ . '/tmp'
]);

// inclusion of our Controllers
// TODO : autoloader
require 'src/controller/ArticleController.php';
require 'src/controller/CommentController.php';
require 'src/controller/MemberController.php';

// inclusion of our Classes
use ClaireC\src\model\Article;
use ClaireC\src\model\Comment;
use ClaireC\src\model\Member;


// instanciation of our classes
$articleController = new ArticleController();
$commentController = new CommentController();
$memberController = new MemberController();


// Routing
$page = "home";

if(isset($_GET['page'])) {
    $page = $_GET['page'];
}

if(isset($_GET['numPage'])) {
    $numPage = $_GET['numPage'];
}

switch ($page) {
    case 'home':
        echo $twig->render('home.twig');
        break;
    case 'contact':
        echo $twig->render('contact.twig');
        break;
    case 'blog':
        $articleController->listArticles();
        break;
    case 'article':
        $articleController->getArticle();
        break;
    case 'addArticle':
        $articleIsAdded = $articleController->addArticle();
        if($articleIsAdded) {
            $msgAddArticle = "<p class='alert alert-success'>Votre article a bien été ajouté</p>";
        } else {
            $msgAddArticle = "";
        }
        echo $twig->render('blogFormAddArticle.twig', array(
            'msgAddArticle' => $msgAddArticle
        ));
        break;
    case 'inscription':
        $memberController->createMember();
        break;
    case 'connexion':
        $memberController->connectMember();
        break;
    default :
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');                        
}


