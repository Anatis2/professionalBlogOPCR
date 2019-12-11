<?php

namespace ClaireC\controller;

use ClaireC\DAO\CommentManager;

class CommentController extends Controller {

    /**
     * List all the comments by article ID
     * @return array
     */
    public function listCommentsById() {
        $commentManager = new CommentManager();
        $comments = $commentManager->listCommentsById();
        return $comments->fetchAll();
    }

    /**
     * Verify $_POST superglobals and add a comment in DB by calling commentManager
     * @return bool|false|PDOStatement
     */
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

    /**
     * List all comments by statute and permit filters by statute and by author
     * @return array|bool|false|PDOStatement
     */
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

    /**
     * Get all comments authors
     * @return array
     */
    public function getAuthorsComments() {
        $commentManager = new CommentManager();
        $authorsComments = $commentManager->getAuthorsComments()->fetchAll();
        return $authorsComments;
    }

    /**
     * Get page ManageComments if the user is admin
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
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
