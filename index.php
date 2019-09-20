<?php

require 'vendor/autoload.php';
require 'controller/functions.php';

// Mise en place pour faire fonctionner Twig
$loader = new Twig_Loader_Filesystem(__DIR__ . '/templates');

$twig = new Twig_Environment($loader, [
    'cache' => false, // __DIR__ . '/tmp'
]);


// Routing

$page = "home";

if(isset($_GET['page'])) {
    if ($_GET['page'] == "home") {
        echo $twig->render('home.twig');
    } elseif ($_GET['page'] == "contact") {
        echo $twig->render('contact.twig');
    } elseif ($_GET['page'] == "blog") {
        echo $twig->render('blogArticles.twig', ['articles' => listArticles()]);
    } elseif ($_GET['page'] == "article") {
        if(isset($_GET['idArticle'])) {
            if(($_GET['idArticle']) > 0) {
                echo $twig->render('blogArticle.twig', ['articles' => getArticle()]);
            } else {
                echo "Il n'y a pas d'article associé à cet identifiant";
            }
        }
    }else {
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');
    }
} else {
    echo $twig->render('home.twig');
}




