<?php

// inclusion of Twig's autoloader
require 'vendor/autoload.php';

// inclusion of Pagerfanta
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

// inclusion of our Controllers
require 'controller/ArticleController.php';
require 'controller/CommentController.php';

// Initiation to use Twig
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false, // __DIR__ . '/tmp'
]);


// Routing

$page = "home";

if(isset($_GET['page'])) {
    $page = $_GET['page'];
}

switch ($page) {
    case 'home':
        echo $twig->render('home.twig');
        break;
    case 'contact':
        echo $twig->render('contact.twig');
        break;
    case 'blog':
        $articleController = new ArticleController();
        echo $twig->render('blogArticles.twig', 
                            ['articles' => $articleController->listArticles(),
                             'nbPages' => $articleController->countPages()
                            ]);
        break;
    case 'article':
        $articleController = new ArticleController();
        $commentController = new CommentController();
        if(isset($_GET['idArticle'])) {
            if(($_GET['idArticle']) > 0) {
                echo $twig->render('blogArticle.twig',
                                    ['articles' => $articleController->getArticle(),
                                        'comments' => $commentController->listComments()
                                    ]);
            } else {
                echo "Il n'y a pas d'article associé à cet identifiant";
            }
        }
        break;
    default :
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');                        
}




