<?php

//namespace ClaireC\src\controller;

// inclusion of Pagerfanta
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

require_once('src/DAO/ArticleManager.php');
//require_once('src/controller/CommentController.php');


class ArticleController extends \ClaireC\controller\controller {

    public function listArticles() {
        $articleManager = new ArticleManager();
        $articles = $articleManager->listArticles();
        return $articles;
    }

    public function pagesManager() {
        $articles = $this->listArticles();
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
                    ['messageArticles' => "<div class='articles'><p>Cette page n'existe pas...</p></div>"
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
        $commentController = new CommentController();
        $msgComments = "";
        $msgNewComment = "";
        if((isset($_GET['idArticle']) && ($_GET['idArticle']) > 0)) {
            if((isset($_POST['pseudo'])) && (isset($_POST['comment'])) && (!empty($_POST['pseudo'])) && (!empty($_POST['comment']))) {
                function getCaptcha($secretKey) {
                    $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfA2b4UAAAAALrGE9pFN7-kXFO_A5zIrwKVAQ5R&response={$secretKey}");
                    $Return = json_decode($Response);
                    return $Return;
                }
                $Return = getCaptcha($_POST['g-recaptcha-response']);
                if(($Return->success==true)&&($Return->score > 0.5)) {
                    $msgNewComment = "<p class='alert alert-success'>Votre commentaire a bien été enregistré et est en attente de modération.</p>";
                    $commentController->addComment();
                } else {
                    $msgNewComment = "<p class='alert alert-danger'>Votre commentaire n'a pas été enregistré car nous pensons qu'il s'agit d'un spam.</p>";
                }
            } else {
                $msgNewComment = "<p class='alert alert-danger'>Veuillez remplir tous les champs</p>";
            }
            $article = $articleManager->getArticle()->fetchAll();
            $comments = $commentController->listCommentsById();
            if((!empty($article)&&(empty($comments)))) {
                $msgComments = "Il n'y a pas de commentaire associé à cet article.";
            }
            echo $this->twig->render('blogArticle.twig',
                ['articles' => $article,
                    'comments' => $comments,
                    'messageComment' => $msgComments,
                    'msgNewComment' => $msgNewComment
                ]);
        } else {
            header('HTTP/1.0 404 Not Found');
            echo $this->twig->render('404.twig');
        }
    }

    public function addArticle() {
        $articleManager = new ArticleManager();
        if(isset($_POST['titleArticle']) && isset($_POST['subtitleArticle']) && isset($_POST['contentArticle'])) {
            $titleArticle = htmlspecialchars($_POST['titleArticle']);
            $subtitleArticle = htmlspecialchars($_POST['titleArticle']);
            $contentArticle = htmlspecialchars($_POST['contentArticle']);
            $person_idPerson = 1;
            $articleIsAdded = $articleManager->addArticle($titleArticle, $subtitleArticle, $contentArticle, $person_idPerson);
            if ($articleIsAdded) {
                $msgAddArticle = "<p class='alert alert-success'>Votre article a bien été ajouté</p>";
            } else {
                $msgAddArticle = "";
            }
            return $msgAddArticle;
        }

    }

    public function getPageAdminAddArticle() {
        $isConnected = parent::verifyConnection();
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
            echo $this->twig->render('adminAddArticle.twig',
                [   'isConnected' => $isConnected,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'msgAddArticle' => $this->addArticle()
                ]);
        } else {
            echo $this->twig->render('403.twig');
        }
    }

    public function getPageManageArticle() {
        $isConnected = parent::verifyConnection();
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
            echo $this->twig->render('adminManageArticles.twig',
                [   'isConnected' => $isConnected,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>"
                ]);
        } else {
            echo $this->twig->render('403.twig');
        }
    }



}


    

