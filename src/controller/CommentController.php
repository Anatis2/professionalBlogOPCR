<?php

require_once('src/DAO/CommentManager.php');

class CommentController {

    public function listComments() {
        $commentManager = new CommentManager();
        $comments = $commentManager->listComments();
        return $comments->fetchAll();
    }

}