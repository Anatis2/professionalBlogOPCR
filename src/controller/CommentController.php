<?php

require_once('src/DAO/CommentManager.php');

class CommentController {

    public function listComments() {
        $commentManager = new CommentManager();
        $comments = $commentManager->listComments();
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
        $commentsToValidate = $commentManager->listCommentsToValidate()->fetchAll();
        return $commentsToValidate;

    }

}
