<?php

// inclusion of Twig's autoloader
require 'vendor/autoload.php';

// initialisation to use Twig
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');
$twig = new Twig_Environment($loader, [
    'cache' => false, // __DIR__ . '/tmp'
]);

// inclusion of our Controllers
require 'controller/ArticleController.php';
require 'controller/CommentController.php';
require 'controller/MemberController.php';


// load of our classes
// TODO : autoloader
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
        if(isset($_GET['idArticle'])) {
            $nbArticles = $articleController->countArticles();
            $comments = $commentController->listComments();
            if((($_GET['idArticle']) > 0) && (($_GET['idArticle']) <= $nbArticles[0])) {
                echo $twig->render('blogArticle.twig',
                    ['articles' => $articleController->getArticle(),
                        'comments' => $commentController->listComments(),
                    ]);
            } elseif ((($_GET['idArticle']) > 0) && (($_GET['idArticle']) <= $nbArticles[0]) && (empty($comments))) { // comment entrer dans cette boucle ?
                echo $twig->render('blogArticle.twig',
                    ['articles' => $articleController->getArticle(),
                        'messageComment' => "Il n'y a pas de commentaire associé à cet article."
                    ]);
            } else {
                echo $twig->render('blogArticle.twig',
                    ['messageArticle' => "Il n'y a pas d'article associé à cet ID.",
                        'messageComment' => "Il n'y a pas de commentaire associé à cet article.",
                    ]);
            }
        }
        break;
    case 'inscription':
        if((isset($_POST['surname']) && (isset($_POST['firstname']))) && (isset($_POST['password'])) && (isset($_POST['passwordConf']))) {
            $surname = htmlspecialchars(trim($_POST['surname']));
            $firstname = htmlspecialchars(trim($_POST['firstname']));
            $password = htmlspecialchars(trim($_POST['password']));
            $passwordConf = htmlspecialchars(trim($_POST['passwordConf']));
            $passwordHash = htmlspecialchars(trim(password_hash($_POST['password'], PASSWORD_DEFAULT)));
            if (($password) == ($passwordConf)) {
                echo $twig->render('inscription.twig',
                    ['affectedLines' => $memberController->createMember($_POST['surname'], $_POST['firstname'], $_POST['password']),
                        'message' => "<p class='alert alert-success'>Votre inscription a bien été prise en compte !</p>"
                    ]);
            } else {
                echo $twig->render('inscription.twig',
                    ['message' => "<p class='alert alert-warning'>Les deux mots de passe ne correspondent pas...</p>"
                    ]);
            }
        }
        echo $twig->render('inscription.twig');
        break;
    case 'connexion':
        echo $twig->render('connexion.twig');
        break;
    default :
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');                        
}




