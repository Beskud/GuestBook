<?php

namespace Models;

use Core\Model;
use Exception;
use PDO;

class MainModel extends Model
{
    public function setComment($username, $text_comment)
    {
        $response = [];

        try {
    
            $name = htmlspecialchars($username);
            $sth = $this->dbh->prepare(
                "INSERT INTO Comment(text_comment, name) 
                    VALUES (:text_comment, :name)"
            );

            $sth->bindParam(':text_comment', $text_comment);
            $sth->bindParam(':name', $name);
            $sth->execute();
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
            "SELECT * FROM Comment"
        );
        $sth->execute();
        $comment = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $comment;   
    }
}
