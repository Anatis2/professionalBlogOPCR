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

session_start();
if(!empty($_SESSION)) {
    $isConnected = true;
    $pseudoPerson = $_SESSION['pseudoPerson'];
} else {
    $isConnected = false;
}

switch ($page) {
    case 'home':
        if($isConnected) {
            echo $twig->render('home.twig',
                ['messageConnection' => "<p class='alert alert-success'>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'lienDeconnexion' => "<a href=\"index.php?page=deconnexion\">Se déconnecter</a>"
                ]);
        } else {
            echo $twig->render('home.twig');
        }
        break;
    case 'contact':
        if($isConnected) {
            echo $twig->render('contact.twig',
                ['messageConnection' => "<p class='alert alert-success'>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'lienDeconnexion' => "<a href=\"index.php?page=deconnexion\">Se déconnecter</a>"
                ]);
        } else {
            echo $twig->render('contact.twig');
        }
        break;
    case 'blog':
        $articleController->listArticles();
        break;
    case 'article':
        $articleController->getArticle();
        break;
    case 'addArticle':
        if($isConnected) {
            echo $twig->render('blogFormAddArticle.twig',
                ['msgAddArticle' => $articleController->addArticle(),
                    'messageConnection' => "<p class='alert alert-success'>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'lienDeconnexion' => "<a href=\"index.php?page=deconnexion\">Se déconnecter</a>"
                ]);
        } else {
            echo $twig->render('403.twig');
        }
        break;
    case 'inscription':
        if($isConnected) {
            echo $twig->render('403Inscription.twig',
                ['messageConnection' => "<p class='alert alert-success'>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'lienDeconnexion' => "<a href=\"index.php?page=deconnexion\">Se déconnecter</a>"
                ]);
        } else {
            $memberController->createMember();
            echo $twig->render('inscription.twig');
        }
        break;
    case 'connexion':
        echo $twig->render('connection.twig',
            [ 'messageConnection' => $memberController->connectMember()
            ]);
        break;
    case 'deconnexion':
        header('Location: index.php?page=home');
        session_destroy();
        break;
    default :
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');                        
}


