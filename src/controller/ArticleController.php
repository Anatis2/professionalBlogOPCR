<?php

// inclusion of Pagerfanta
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

require_once('src/DAO/ArticleManager.php');


class ArticleController {

    public function __construct() {
        // Initilisation to use Twig
        $loader = new Twig_Loader_Filesystem('templates');
        $this->twig = new Twig_Environment($loader, [
            'cache' => false, // __DIR__ . '/tmp'
        ]);
    }

    public function listArticles() {

        $articleManager = new ArticleManager();
        $articles = $articleManager->listArticles();

        $adapter = new ArrayAdapter($articles->fetchAll());
        $pagerfanta = new Pagerfanta($adapter);

        $pagerfanta->setMaxPerPage(8); // set the max number of articles by page
        $maxPerPage = $pagerfanta->getMaxPerPage(); // get the max number of articles by page

        $nbResults = $pagerfanta->getNbResults(); // get the total number of articles in the db
        $nbPages = $pagerfanta->getNbPages(); // get the total number of pages (consider the maxPerPage)

        $currentPageResults = $pagerfanta->getCurrentPageResults(); // list the articles (consider the maxPerPage and the currentPage)

        if (isset($_GET['numPage'])) {
            if (($_GET['numPage']) == 1) {
                $pagerfanta->setCurrentPage($_GET['numPage']);
                $currentPage = $pagerfanta->getCurrentPage();
                $currentPageResults = $pagerfanta->getCurrentPageResults(); // list the articles (consider the maxPerPage and the currentPage)
                $nextPage = $pagerfanta->getNextPage();
                echo $this->twig->render('blogArticles.twig',
                    ['articles' => $currentPageResults,
                        'textPreviousPage' => "",
                        'currentPage' => $currentPage,
                        'textNextPage' => "Page suivante",
                        'nextPage' => $nextPage
                    ]);
            } elseif ((($_GET['numPage']) > 1) && (($_GET['numPage']) < $nbPages)) {
                $pagerfanta->setCurrentPage($_GET['numPage']);
                $currentPage = $pagerfanta->getCurrentPage();
                $currentPageResults = $pagerfanta->getCurrentPageResults(); // list the articles (consider the maxPerPage and the currentPage)
                $nextPage = $pagerfanta->getNextPage();
                $previousPage = $pagerfanta->getPreviousPage();
                echo $this->twig->render('blogArticles.twig',
                    ['articles' => $currentPageResults,
                        'textPreviousPage' => "Page précédente",
                        'previousPage' => $previousPage,
                        'currentPage' => $currentPage,
                        'textNextPage' => "Page suivante",
                        'nextPage' => $nextPage
                    ]);
            } elseif (($_GET['numPage']) == $nbPages) {
                $pagerfanta->setCurrentPage($_GET['numPage']);
                $currentPage = $pagerfanta->getCurrentPage();
                $currentPageResults = $pagerfanta->getCurrentPageResults(); // list the articles (consider the maxPerPage and the currentPage)
                $previousPage = $pagerfanta->getPreviousPage();
                echo $this->twig->render('blogArticles.twig',
                            ['articles' => $currentPageResults,
                                'currentPage' => $currentPage,
                                'textPreviousPage' => "Page précédente",
                                'previousPage' => $previousPage,
                                'textNextPage' => ""
                            ]);
            } else {
                echo $this->twig->render('blogArticles.twig',
                                ['message' => "<div class='articles'><p>Cette page n'existe pas...</p></div>"
                                ]);
            }
        } else {
            $pagerfanta->setCurrentPage(1);
            $currentPage = $pagerfanta->getCurrentPage();
            $nextPage = $pagerfanta->getNextPage();
            echo $this->twig->render('blogArticles.twig',
                ['articles' => $currentPageResults,
                    'textPreviousPage' => "",
                    'currentPage' => $currentPage,
                    'textNextPage' => "Page suivante",
                    'nextPage' => $nextPage
                ]);
        }
    }

    public function getArticle() {
        $articleManager = new ArticleManager();
        return $articleManager->getArticle();
    }

    public function countArticles() {
        $articleManager = new ArticleManager();
        return $articleManager->countArticles()->fetch();
    }

}


    

