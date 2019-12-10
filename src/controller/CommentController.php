<?php

require_once 'src/DAO/CommentManager.php';

class CommentController extends \ClaireC\controller\Controller {

    public function listCommentsById() {
        $commentManager = new CommentManager();
        $comments = $commentManager->listCommentsById();
        return $comments->fetchAll();
    }
    
    public function addComment() {
        $commentManager = new CommentManager(); 
        if((isset($_POST['pseudo'])) && (isset($_POST['comment'])) && (!empty($_POST['pseudo'])) && (!empty($_POST['comment']))) {
            $pseudo = parent::defaultPostControl('pseudo');
            $comment = parent::defaultPostControl('comment');
            $idArticle = parent::defaultGetControl('idArticle');
            $newComments = $commentManager->addComment($pseudo,$comment, $idArticle);
            return $newComments;
        }
    }

    public function listCommentsToValidate() {
        $commentManager = new CommentManager();

        if(isset($_GET['idCommentToValidate'])) {
            $idComment = parent::defaultGetControl('idCommentToValidate');
            header('Location: index.php?page=manageComments');
            return $commentManager->validateComment($idComment);
        }
        if(isset($_GET['idCommentToRefuse'])) {
            $idComment = parent::defaultGetControl('idCommentToRefuse');
            header('Location: index.php?page=manageComments');
            return $commentManager->refuseComment($idComment);
        }
        if(isset($_POST['author'])) {
            $author = parent::defaultPostControl('author');
            return $commentManager->filterCommentsByAuthor($author);
        }
        if(isset($_POST['statute'])) {
            $statute = parent::defaultPostControl('statute');
            if($statute === "Tous") {
                return $commentManager->listComments();
            } else {
                return $commentManager->filterCommentsByStatute($statute);
            }
        }
        $commentsToValidate = $commentManager->listCommentsToValidate()->fetchAll();
        return $commentsToValidate;

    }

    public function getAuthorsComments() {
        $commentManager = new CommentManager();
        $authorsComments = $commentManager->getAuthorsComments()->fetchAll();
        return $authorsComments;
    }

    public function getPageManageComments() {
        $isConnected = parent::verifyConnection();
        $isAdmin = parent::isAdmin();
        if($isAdmin) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
            echo $this->twig->render('adminValidComments.twig',
                ['isConnected' => $isConnected,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'commentsToValidate' => $this->listCommentsToValidate(),
                    'authorsComments' => $this->getAuthorsComments(),
                    'isAdmin' => $isAdmin
                ]);
        } else {
            echo $this->twig->render('403.twig');
        }
    }

}
