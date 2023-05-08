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

            $sth = $this->dbh->prepare("SELECT created_at FROM Comment WHERE id = :id");
            $sth->bindParam(':id', $response['id']);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            $response['created_at'] = $result['created_at'];

            $response['comment_id'] = $comment_id;
            $response['text_comment'] = $text_comment;
            $response['status'] = 'success';
            
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public function removeComment($comment_id) {
        $sth = $this->dbh->prepare (
            "UPDATE `Comment`
            SET deleted_at = CURRENT_TIMESTAMP
            WHERE id = :id"
        );
        $sth->bindParam(':id', $comment_id);
        $sth->execute();
    }

    public function GetComment()
    {
        $sth=$this->dbh->prepare (
            "SELECT `Comment`.id, `Users`.username, `Comment`.text_comment, `Comment`.user_id, `Comment`.comment_id, `Comment`.created_at, `Users`.avatar_type
            FROM `Comment`
            INNER JOIN `Users` ON `Users`.id = `Comment`.user_id
            WHERE `Comment`.deleted_at IS NULL"
        );
        $sth->execute();
        $comment = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $comment;   
    }
}
