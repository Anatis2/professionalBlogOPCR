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

}