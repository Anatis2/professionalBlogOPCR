<?php

//namespace ClaireC\src\controller;

// inclusion of Pagerfanta
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

require_once('src/DAO/ArticleManager.php');
//require_once('src/controller/CommentController.php');


class ArticleController extends \ClaireC\controller\Controller {

    /**
     * 
     * @return type
     */
    public function listArticles() {
        $articleManager = new ArticleManager();
        $articles = $articleManager->listArticles()->fetchAll();
        return $articles;
    }

    /**
     * 
     */
    public function pagesManager() {
        $articles = $this->listArticles();
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
        } else {
            $pseudoPerson = "";
        }

        // pagerFanta
        $adapter = new ArrayAdapter($articles);
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
                if($isAdmin) {
                    echo $this->twig->render('adminManageArticles.twig',
                        ['articles' => $currentPageResults,
                            'textPreviousPage' => "",
                            'currentPage' => $currentPage,
                            'textNextPage' => "Page suivante",
                            'nextPage' => $nextPage,
                            'isConnected' => $isConnected,
                            'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                            'isAdmin' => $isAdmin
                        ]);
                } else {
                    echo $this->twig->render('blogArticles.twig',
                        ['articles' => $currentPageResults,
                            'textPreviousPage' => "",
                            'currentPage' => $currentPage,
                            'textNextPage' => "Page suivante",
                            'nextPage' => $nextPage,
                            'isConnected' => $isConnected,
                            'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                            'isAdmin' => $isAdmin
                        ]);
                }
            } elseif ((($_GET['numPage']) > 1) && (($_GET['numPage']) < $nbPages)) {
                $pagerfanta->setCurrentPage($_GET['numPage']);
                $currentPage = $pagerfanta->getCurrentPage();
                $currentPageResults = $pagerfanta->getCurrentPageResults(); // list the articles (consider the maxPerPage and the currentPage)
                $nextPage = $pagerfanta->getNextPage();
                $previousPage = $pagerfanta->getPreviousPage();
                if($isAdmin) {
                    echo $this->twig->render('adminManageArticles.twig',
                        ['articles' => $currentPageResults,
                            'textPreviousPage' => "Page précédente",
                            'previousPage' => $previousPage,
                            'currentPage' => $currentPage,
                            'textNextPage' => "Page suivante",
                            'nextPage' => $nextPage,
                            'isConnected' => $isConnected,
                            'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                            'isAdmin' => $isAdmin
                        ]);
                } else {
                    echo $this->twig->render('blogArticles.twig',
                        ['articles' => $currentPageResults,
                            'textPreviousPage' => "Page précédente",
                            'previousPage' => $previousPage,
                            'currentPage' => $currentPage,
                            'textNextPage' => "Page suivante",
                            'nextPage' => $nextPage,
                            'isConnected' => $isConnected,
                            'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                            'isAdmin' => $isAdmin
                        ]);
                }
            } elseif (($_GET['numPage']) == $nbPages) {
                $pagerfanta->setCurrentPage($_GET['numPage']);
                $currentPage = $pagerfanta->getCurrentPage();
                $currentPageResults = $pagerfanta->getCurrentPageResults(); // list the articles (consider the maxPerPage and the currentPage)
                $previousPage = $pagerfanta->getPreviousPage();
                if($isAdmin) {
                    echo $this->twig->render('adminManageArticles.twig',
                        ['articles' => $currentPageResults,
                            'currentPage' => $currentPage,
                            'textPreviousPage' => "Page précédente",
                            'previousPage' => $previousPage,
                            'textNextPage' => "",
                            'isConnected' => $isConnected,
                            'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                            'isAdmin' => $isAdmin
                        ]);
                } else {
                    echo $this->twig->render('blogArticles.twig',
                        ['articles' => $currentPageResults,
                            'currentPage' => $currentPage,
                            'textPreviousPage' => "Page précédente",
                            'previousPage' => $previousPage,
                            'textNextPage' => "",
                            'isConnected' => $isConnected,
                            'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                            'isAdmin' => $isAdmin
                        ]);
                }
            } else {
                if($isAdmin) {
                    echo $this->twig->render('adminManageArticles.twig',
                        ['messageArticles' => "<div class='articles'><p>Cette page n'existe pas...</p></div>",
                            'isAdmin' => $isAdmin
                        ]);
                } else {
                    echo $this->twig->render('blogArticles.twig',
                        ['messageArticles' => "<div class='articles'><p>Cette page n'existe pas...</p></div>",
                            'isConnected' => $isConnected
                        ]);
                }
            }
        } else {
            $pagerfanta->setCurrentPage(1);
            $currentPage = $pagerfanta->getCurrentPage();
            $nextPage = $pagerfanta->getNextPage();
            if($isAdmin) {
                echo $this->twig->render('adminManageArticles.twig',
                    ['articles' => $currentPageResults,
                        'textPreviousPage' => "",
                        'currentPage' => $currentPage,
                        'textNextPage' => "Page suivante",
                        'nextPage' => $nextPage,
                        'isConnected' => $isConnected,
                        'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                        'isAdmin' => $isAdmin
                    ]);
            } else {
                echo $this->twig->render('blogArticles.twig',
                    ['articles' => $currentPageResults,
                        'textPreviousPage' => "",
                        'currentPage' => $currentPage,
                        'textNextPage' => "Page suivante",
                        'nextPage' => $nextPage,
                        'isConnected' => $isConnected,
                        'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                        'isAdmin' => $isAdmin
                    ]);
            }

        }
    }

    /**
     * 
     */
    public function getArticle() {
        $articleManager = new ArticleManager();
        $commentController = new CommentController();
        $msgComments = "";
        $msgNewComment = "";
        $pseudoPerson = "";
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        if((isset($_GET['idArticle']) && ($_GET['idArticle']) > 0)) {
            if((isset($_POST['pseudo'])) && (isset($_POST['comment']))) {
                if ((empty($_POST['pseudo'])) || (empty($_POST['comment']))) {
                    $msgNewComment = "<p class='alert alert-danger'>Veuillez remplir tous les champs</p>";
                } else {
                    function getCaptcha($secretKey) {
                        $Response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfA2b4UAAAAALrGE9pFN7-kXFO_A5zIrwKVAQ5R&response={$secretKey}");
                        $Return = json_decode($Response);
                        return $Return;
                    }
                    $Return = getCaptcha($_POST['g-recaptcha-response']);
                    if(($Return->success==true)&&($Return->score > 0.5)) {
                        $msgNewComment = "<p class='alert alert-success'>Votre commentaire a bien été enregistré et est en attente de modération.</p>";
                        $commentController->addComment();
                    }  else {
                        $msgNewComment = "<p class='alert alert-danger'>Votre commentaire n'a pas été enregistré car nous pensons qu'il s'agit d'un spam.</p>";
                    }
                }
            }
            $article = $articleManager->getArticle()->fetchAll();
            $comments = $commentController->listCommentsById();
            if((!empty($article)&&(empty($comments)))) {
                $msgComments = "Il n'y a pas de commentaire associé à cet article.";
            }
            if($isConnected) {
                $pseudoPerson = $_SESSION['pseudoPerson'];
            }
            if($isAdmin) {
                echo $this->twig->render('adminManageArticle.twig',
                    ['articles' => $article,
                        'comments' => $comments,
                        'messageComment' => $msgComments,
                        'msgNewComment' => $msgNewComment,
                        'isConnected' => $isConnected,
                        'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                        'isAdmin' => $isAdmin
                    ]);
            } else {
                echo $this->twig->render('blogArticle.twig',
                    ['articles' => $article,
                        'comments' => $comments,
                        'messageComment' => $msgComments,
                        'msgNewComment' => $msgNewComment,
                        'isConnected' => $isConnected,
                        'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                        'isAdmin' => $isAdmin
                    ]);
            }
        } else {
            header('HTTP/1.0 404 Not Found');
            echo $this->twig->render('404.twig');
        }
    }

    /**
     * 
     * @return string
     */
    public function addArticle() {
        $articleManager = new ArticleManager();
        if(isset($_POST['titleArticle']) && isset($_POST['subtitleArticle']) && isset($_POST['contentArticle'])) {
            $titleArticle = htmlspecialchars($_POST['titleArticle']);
            $subtitleArticle = htmlspecialchars($_POST['subtitleArticle']);
            $contentArticle = htmlspecialchars($_POST['contentArticle']);
            $person_idPerson = $_SESSION['idPerson'];
            $articleIsAdded = $articleManager->addArticle($titleArticle, $subtitleArticle, $contentArticle, $person_idPerson);
            if ($articleIsAdded) {
                $msgAddArticle = "<p class='alert alert-success'>Votre article a bien été ajouté</p>";
            } else {
                $msgAddArticle = "";
            }
            return $msgAddArticle;
        }
    }

    /**
     * 
     */
    public function getPageAdminAddArticle() {
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
            echo $this->twig->render('adminAddArticle.twig',
                [   'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'msgAddArticle' => $this->addArticle()
                ]);
        } else {
            echo $this->twig->render('403.twig');
        }
    }

    /**
     * 
     */
    public function getPageContact() {
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
        } else {
            $pseudoPerson = "";
        }

        if(isset($_POST['name'])&&isset($_POST['surname'])&&isset($_POST['email'])&&isset($_POST['object'])&&isset($_POST['message'])) {
            $name = htmlentities($_POST['name']);
            $surname = htmlentities($_POST['surname']);
            $email = htmlentities($_POST['email']);
            $object = htmlentities($_POST['object']);
            $message = htmlentities($_POST['message']);
            if((!empty($name))&&(!empty($surname))&&(!empty($email))&&(!empty($object))&&(!empty($message))) {
                // Create the Transport
                $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                        ->setAuthMode('login')
                            ->setUsername('claire.coubard.test@gmail.com')
                            ->setPassword('test14120*');

                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                // Create a message
                $message = (new Swift_Message('Wonderful Subject'))
                    ->setFrom(['claire.coubard@gmail.com' => 'John Doe'])
                    ->setTo(['claire.coubard.test@gmail.com' => 'A name'])
                    ->setBody('Here is the message itself')
                ;

                echo "<pre>";
                var_dump($message);
                echo "</pre>";
                // Send the message
                $result = $mailer->send($message);

                echo $this->twig->render('contact.twig',
                    [   'isConnected' => $isConnected,
                        'isAdmin' => $isAdmin,
                        'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                        'messageMail' => "<p class='alert alert-success'>A GERER</p>",
                    ]);
            } else {
                echo $this->twig->render('contact.twig',
                    [   'isConnected' => $isConnected,
                        'isAdmin' => $isAdmin,
                        'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                        'messageMail' => "<p class='alert alert-danger'>Veuillez remplir tous les champs.</p>"
                    ]);
            }
        } else {
            echo $this->twig->render('contact.twig',
                [   'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>"
                ]);
        }
    }

    /**
     * 
     */
    public function getPageHome() {
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
            echo $this->twig->render('home.twig',
                [   'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'msgAddArticle' => $this->addArticle()
                ]);
        } else {
            echo $this->twig->render('home.twig');
        }
    }

    /**
     * 
     */
    public function modifyArticle() {
        $articleManager = new ArticleManager();
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        $msgModifyArticle = "";
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
            if(isset($_POST['titleArticle']) && isset($_POST['subtitleArticle']) && isset($_POST['contentArticle'])) {
                $titleArticle = $_POST['titleArticle'];
                $subtitleArticle = $_POST['subtitleArticle'];
                $contentArticle = $_POST['contentArticle'];
                $articleManager->modifyArticle($titleArticle, $subtitleArticle, $contentArticle);
                $msgModifyArticle = "<p class='alert alert-success'>Votre article a bien été modifié</p>";
            }
            $article = $articleManager->getArticle()->fetchAll();
            echo $this->twig->render('adminModifyArticle.twig',
                [   'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'article' => $article[0],
                    'msgModifyArticle' => $msgModifyArticle
                ]);
        } else {
            echo $this->twig->render('403.twig');
        }
    }

    /**
     * 
     */
    public function deleteArticle() {
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        $articleManager = new ArticleManager();
        $idArticle = $_GET['idArticle'];
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
        } else {
            $pseudoPerson = "";
        }
        if(isset($_GET['conf'])) {
            $articleManager->deleteArticle($idArticle);
            echo $this->twig->render('confAdminDeleteArticle.twig',
                [
                    'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'idArticle' => $_GET['idArticle'],
                    'msgSupprArticle' => "<p class='alert alert-success'>L'article a bien été supprimé</p>"
                ]);
        } else {
            echo $this->twig->render('adminDeleteArticle.twig',
                [
                    'isConnected' => $isConnected,
                    'isAdmin' => $isAdmin,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'idArticle' => $_GET['idArticle']
                ]);
        }

    }

}


    

