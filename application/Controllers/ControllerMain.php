<?php

namespace Controllers;

use Core\Controller;
use Models\MainModel;
use Models\UsersModel;

class ControllerMain extends Controller
{
    public $user;
    public function __construct()
	{
		parent::__construct();
		$this->user = new MainModel();
	}

    public function actionIndex()
    {
        $this->view->generate('main_view.php', 'template_view.php');
    }

    public function actionMain()
    {
        if (!empty($_POST['text_comment'])) {
            if (preg_match('/^[\p{L}\d\s,.\(\)!\";:\[\]{}\#$@%&]{3,60}$/ui', $_POST['text_comment'])) {
                $text_comment = $_POST['text_comment'];
                
                $created = $_POST['created'];
                $comment_id = null;
                    if (isset($_POST['comment_id'])) {
                        $comment_id = $_POST['comment_id'];
                    };
                $response = $this->user->setComment($text_comment, $comment_id);
                $response['avatar_type'] = $_SESSION['user_data']['avatar_type'];
                $response['username'] = $_SESSION['user_data']['username'];
                echo json_encode($response);
            } else {
                $response['status'] = 'bad';
                echo json_encode($response);
            }
        } else {
            $response['status'] = 'bad';
            echo json_encode($response);
        }
    }
    public function actionGetComment()
    {    
        $comment = $this->user->GetComment();
        echo json_encode($comment);
    }
    
    public function actionRemove()
    {    
        if ($_SESSION['user_data']['is_admin']) {
            $this->user->removeComment($_POST['comment_id']);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }

    public function actionchangeUserAvatar() {
        if (!empty($_POST['id'])){
            $changeUserAvatar = new UsersModel();
            $UserAvatar = $changeUserAvatar->changeAvatar($_POST['id']);
            if($UserAvatar) {
                $_SESSION['user_data']['avatar_type'] = $_POST['id'];
            }
            echo $UserAvatar;
        } 
    }
}

