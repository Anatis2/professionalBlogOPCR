<?php

// Mise en place pour faire fonctionner Twig

require 'vendor/autoload.php';
require 'controller/functions.php';

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
        echo $twig->render('blog.twig', ['articles' => listArticles()]);
    } else {
        header('HTTP/1.0 404 Not Found');
        echo $twig->render('404.twig');
    }
} else {
    echo $twig->render('home.twig');
}




