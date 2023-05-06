<?php

namespace Models;

use Core\Model;
use Exception;
use PDO;

class MainModel extends Model
{
    public function setComment($text_comment, $comment_id)
    {
    
        $response = [];

        try {
            
            $sth = $this->dbh->prepare(
                "INSERT INTO Comment(text_comment, user_id, comment_id) 
                    VALUES (:text_comment, :user_id, :comment_id)"
            );

            $user_id = $_SESSION['user_data']['id'];
            $sth->bindParam(':text_comment', $text_comment);
            $sth->bindParam(':user_id', $user_id);
            $sth->bindParam(':comment_id', $comment_id);
            $sth->execute();
            $response['id'] = $this->dbh->lastInsertId();
            $response['comment_id'] = $comment_id;
            $response['text_comment'] = $text_comment;
            $response['status'] = 'success';
            
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function GetComment()
    {
        $sth=$this->dbh->prepare (
            "SELECT  `Comment`.id, username, text_comment, user_id, comment_id, avatar_type
                FROM `Comment`
                INNER JOIN Users
                ON `Users`.id = user_id"
        );
        $sth->execute();
        $comment = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $comment;   
    }
}
