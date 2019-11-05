<?php

require_once('src/DAO/CommentManager.php');

class CommentController extends \ClaireC\controller\controller {

    public function listCommentsById() {
        $commentManager = new CommentManager();
        $comments = $commentManager->listCommentsById();
        return $comments->fetchAll();
    }
    
    public function addComment() {
        $commentManager = new CommentManager(); 
        if((isset($_POST['pseudo'])) && (isset($_POST['comment']))) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $comment = htmlspecialchars($_POST['comment']);
            $idArticle = htmlspecialchars($_GET['idArticle']);
            $newComments = $commentManager->addComment($pseudo,$comment, $idArticle);
            return $newComments;
        }
    }

    public function listCommentsToValidate() {
        $commentManager = new CommentManager();

        if(isset($_GET['idCommentToValidate'])) {
            $idComment = $_GET['idCommentToValidate'];
            header('Location: index.php?page=manageComments');
            return $commentManager->validateComment($idComment);
        }
        if(isset($_GET['idCommentToRefuse'])) {
            $idComment = $_GET['idCommentToRefuse'];
            header('Location: index.php?page=manageComments');
            return $commentManager->refuseComment($idComment);
        }
        if(isset($_POST['author'])) {
            $author = $_POST['author'];
            return $commentManager->filterCommentsByAuthor($author);
        }
        if(isset($_POST['statute'])) {
            $statute = $_POST['statute'];
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
        if($isConnected) {
            $pseudoPerson = $_SESSION['pseudoPerson'];
            echo $this->twig->render('adminValidComments.twig',
                ['isConnected' => $isConnected,
                    'messageConnection' => "<p>Vous êtes connecté en tant que $pseudoPerson</p>",
                    'commentsToValidate' => $this->listCommentsToValidate(),
                    'authorsComments' => $this->getAuthorsComments()
                ]);
        } else {
            echo $this->twig->render('403.twig');
        }
    }

}
