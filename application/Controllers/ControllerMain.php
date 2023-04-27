<?php

namespace Controllers;

use Core\Controller;
use Models\MainModel;


class ControllerMain extends Controller
{
    public function actionIndex()
    {
        $this->view->generate('main_view.php', 'template_view.php');
    }

    public function actionMain()
    {
        if (!empty($_POST['username']) && !empty($_POST['text_comment'])) {
    
            if (preg_match('/^[\p{L}\d\s]{3,30}$/ui', $_POST['text_comment'])) {
                $text_comment = $_POST['text_comment'];
            } 
            $username = $_POST['username'];
            $getComment = new MainModel();
            $comment = $getComment->setComment($username, $text_comment);

            $response['status'] = 'success';
            echo json_encode($response);
        } else {
            $response['status'] = 'bad';
            echo json_encode($response);
        }
    }
    public function actionGetComment()
    {    
        $GetComment = new MainModel();
        $comment = $GetComment->GetComment();
        echo json_encode($comment);
    }
}


